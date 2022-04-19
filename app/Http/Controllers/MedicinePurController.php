<?php

namespace App\Http\Controllers;

use App\Models\Medicineper;
use Illuminate\Http\Request;
use App\Models\Locationrack;

class MedicinePurController extends Controller
{

    function index()
    {
        if (request()->ajax()) {
            return Datatables()->of(Medicineper::select('*'))
                ->addColumn('action', 'medicine-action')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('medicine-pur');
    }
    function store(Request $request)
    {
        $medicineId = $request->id;
        // $rackid = $request->rack;
        // $rackfind = Locationrack::find($rackid);
        // $rack = $rackfind->name;

        $medicineStore = Medicineper::updateOrCreate(
            [
                'id' => $medicineId
            ],
            [
                'name' => $request->name,
                'company' => $request->company,
                'quantity' => $request->quantity,
                'rack' => $request->rack,
                'supplier' => $request->supplier,
                'priceparunit' => $request->priceperunit,
                'saleprice' => $request->sale,
                'totalcost' => $request->cost,
                'expairdate' => $request->datepicker
            ]
        );

        return Response()->json($medicineStore);
    }
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $rack  = Medicineper::where($where)->first();

        return Response()->json($rack);
    }
    function delete(Request $request)
    {
        $rack = Medicineper::where('id', $request->id)->delete();

        return Response()->json($rack);
    }

    function perchase(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $supplier = $request->supplier;
        $priceperunit = $request->priceperunit;
        $saleprice = $request->sale;
        $totalcost = $request->cost;
        $expairdate = $request->datepicker;

        $find = Medicineper::find($id);
        $find->quantity += $quantity;
        $find->totalcost += $totalcost;

        $find->supplier = $supplier;
        $find->priceparunit = $priceperunit;
        $find->saleprice = $saleprice;
        $find->expairdate = $expairdate;


        $find->save();
        // $data = $request->quantity;
        return Response()->json('success');
    }
    function search(Request $request)
    {
        $movies = [];

        if ($request->has('q')) {
            $search = $request->q;
            $movies = Locationrack::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->take(10)
                ->get();
        }
        return response()->json($movies);
    }
}
