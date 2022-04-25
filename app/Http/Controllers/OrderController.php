<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicineper;
use App\Models\Order;
use App\Models\Orderdetail;
use PDF;

class OrderController extends Controller
{

    function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Order::select('*'))
                ->addColumn('action', 'order-action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('order');
    }
    function orderadd()
    {
        return view('orderadd');
    }
    function medicinesearch(Request $request)
    {
        $movies = [];

        if ($request->has('q')) {
            $search = $request->q;
            $movies = Medicineper::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->take(10)
                ->get();
        }
        return response()->json($movies);
    }
    function MedicineAdd(Request $request)
    {

        $quantity = $request->quantity;

        $Meid = $request->medicine;
        $medicineGET = Medicineper::where('id', $Meid)->first();

        if ($medicineGET->quantity >= $quantity) {
            $total = $quantity * $medicineGET->saleprice;
            $array[] = json_decode($quantity, true);
            $array[] = json_decode($medicineGET, true);
            $array[] = json_decode($total, true);



            return response()->json($array);
        } else {
            return response()->json(['no' => 'Not enough medicine']);
        }
    }
    function MedicineSubmit(Request $request)
    {
        // return $request->all(); ids
        $total = $request->Tl_amount;
        if ($request->payment_type == 'বাকি') {
            $baki = $total -= $request->baki_message;
        } else {
            $baki = 0;
        }


        $patient = $request->patient;
        $laetstPatient = end($patient);
        // return $laetstPatient;

        $quantitys = array_values($request->quantitys);
        // return $quantitys;
        $unantunit = array_values($request->unantunit);

        $allDatas =  Medicineper::findMany($request->ids);
        // return $allDatas;

        $order = new Order();
        $order->patientname = $laetstPatient;
        $order->amount = $request->Tl_amount;
        $order->type = $request->payment_type;
        $order->bike = $baki;
        $order->other = $request->other_details;
        $order->save();

        $orderId = $order->id;
        // $getOrder = Order::find($orderId); Tl_amount


        foreach ($allDatas as $key => $value) {
            $orderDet = new Orderdetail();
            $orderDet->order_id = $orderId;
            $orderDet->name = $value->name;
            $orderDet->expiry = $value->expairdate;
            $orderDet->medicineid = $request->ids[$key];
            $orderDet->quantity = $quantitys[$key];
            $orderDet->unitprice = $value->saleprice;
            $orderDet->qusumunit = $unantunit[$key];
            $orderDet->save();



            $value->quantity  -= $quantitys[$key];
            $value->save();
        }


        return redirect()->route('ordermanagement')->with('message', 'Order created successfully!');
    }

    function PDF_print(Request $request)
    {

        $find = Order::find($request->id);
        if ($find) {
            $data = [
                'order' => Order::where('id', $request->id)->with('orderdetail')->get()
            ];

            $pdf = PDF::loadView('pdf-print', $data);

            return $pdf->stream();
        } else {
            return "<h1>Invalid URL</h1>";
        }
    }

    function Orderedit(Request $request)
    {
        $datas = Order::where('id', $request->id)->with('orderdetail')->get();
        return view('order-edit', compact('datas'));
    }

    function OrdereditSubmit(Request $request)
    {
        // return  $request->all();
        $id = $request->id;
        $name = $request->name;
        $getunitprice = $request->unitprice;
        $quantity = $request->quantity;
        $medicineId = $request->medicineId;


        $arr = [];
        foreach ($getunitprice as $key => $value) {
            $val = $value * $quantity[$key];
            array_push($arr, $val);
        }

        $get_totalval = array_sum($arr);

        $order = Order::where('id', $id)->with('orderdetail')->get();
        $get_amount = $order[0]->amount - $get_totalval;

        if ($order[0]->type == 'বাকি') {
            $order[0]->bike -= $get_amount;
            $order[0]->save();
        }

        $orderDetails = $order[0]->orderdetail;
        $x = 0;

        foreach ($orderDetails as $key => $orderdetail) {


            $Medicineper = Medicineper::where('id', $medicineId[$key])->get();
            $Medicineper[0]->quantity += $request->previous_quantity[$key] - $quantity[$key];

            // $Medicineper[0]->quantity += 1;
            $Medicineper[0]->save();

            $orderdetail->quantity = $quantity[$key];
            $orderdetail->qusumunit = $orderdetail->unitprice * $quantity[$key];
            $orderdetail->save();
            $x += $orderdetail->qusumunit;
        }
        $order[0]->patientname = $name;
        $order[0]->amount = $x;
        $order[0]->save();
        return redirect()->route('ordermanagement')->with('message', 'Edited Successfully!');
    }
    function remainingorders()
    {
        if (request()->ajax()) {
            return datatables()->of(Order::select('*')->where('type', 'বাকি'))

                ->addColumn('action', 'remaining-action')
                ->addColumn('created_at', function ($row) {
                    // return $row->created_at->format('Y-m-d H:i:s');
                    return $row->created_at->format('d-m-Y');
                })
                ->filterColumn('created_at', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(created_at,'%d-%m-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
                })

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('remaining-orders');
    }
    function remainingedit(Request $request){
        $order = Order::find($request->id);
        return response()->json($order);
    }
    function remainingeditsubmit(Request $request){
        // return $request->all();
            $order = Order::find($request->getId);
            if($request->paymentType[0] == 'নগদ'){
                $order->type = $request->paymentType[0];
                $order->bike = 0;
                $order->save();
                return redirect()->route('ordermanagement')->with('message','Successfully!');
            }
            return redirect()->route('ordermanagement')->with('message','Not Edited!');

    }
}
