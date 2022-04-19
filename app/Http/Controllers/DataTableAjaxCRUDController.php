<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Demo;
use App\Models\User;
use Datatables;

class DataTableAjaxCRUDController extends Controller
{
    //
    public function index(){
        if(request()->ajax()){
            return Datatables()->of(Company::select('*'))
            ->addColumn('action','company-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }
        return view('companies');
    }
    function demo(Request $request){
        $demo = User::first();
        $json1 = '{"aaaa": "bbb"}';
        $array[] = json_decode($json1, true);
        $array[] = json_decode($demo, true);
         return $array;

    }


}
