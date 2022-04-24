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
    function demo(){
        $a = [4,5];
        $b = [5,2];
        $arr = [];

        foreach($a as $key=>$val){
            $xx = $val*$b[$key];
            array_push($arr,$xx);
        }
        return array_sum($arr);

    }


}
