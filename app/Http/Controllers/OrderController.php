<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicineper;
use App\Models\Order;
use App\Models\Orderdetail;
use PDF;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    //
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
        // return $request->all();
        $total = $request->Tl_amount;
        if($request->payment_type == 'বাকি'){
            $baki = $total -= $request->baki_message;
        }else{
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
                'order' => Order::where('id',$request->id)->with('orderdetail')->get()
            ];

            $pdf = PDF::loadView('pdf-print', $data);

            return $pdf->stream();
        } else {
            return "<h1>Invalid URL</h1>";
        }
    }

    function Orderedit(Request $request){
        $datas = Order::where('id',$request->id)->with('orderdetail')->get();
        return view('order-edit',compact('datas'));
    }
}
