<?php

namespace App\Http\Controllers;

use App\Models\Medicineper;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    public function index(){
        $instock =  Medicineper::whereDate('expairdate','>', Carbon::now())
        ->count();
          $outofStoclk =   Medicineper::whereDate('expairdate','<', Carbon::now())
        ->count();
        $totalpurchase = DB::table('medicinepers')->sum('totalcost');
        $sale = DB::table('orders')->sum('amount');
        return view('dashboard',compact('instock','outofStoclk','totalpurchase','sale'));
         
    }
}
