<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locationrack;
use Datatables;

class LocationRackController extends Controller
{
    //
    function index()
    {
        if (request()->ajax()) {
            return Datatables()->of(Locationrack::select('*'))
                ->addColumn('action', 'rack-action')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('location-rack');
    }
    function store(Request $request)
    {
        $rackId = $request->id;

        $company   =   Locationrack::updateOrCreate(
            [
                'id' => $rackId
            ],
            [
                'name' => $request->name,
            ]
        );

        return Response()->json($company);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $rack  = Locationrack::where($where)->first();

        return Response()->json($rack);
    }


    public function delete(Request $request){
        $rack = Locationrack::where('id',$request->id)->delete();

        return Response()->json($rack);
    }
}
