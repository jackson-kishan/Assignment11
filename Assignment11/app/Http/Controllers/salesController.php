<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class salesController extends Controller
{
    public function dashboard() {
        $todaySales = DB::table('products')
                     ->whereDate('created_at', today())
                     ->sum('amount');

        $yesterdaySales = DB::table('products')
                          ->whereDate('created_at', today()->subDays(1))
                          ->sum('amount');

        $thisMonthSales = DB::table('products')
                          ->whereYear('created_at', today()->year)
                          ->whereMonth('created_at', today()->month)
                          ->sum('amount');                  


        $lastMonthSales = DB::table('products')
                           ->whereYear('created_at', today()->subMonth()->year)
                           ->whereMonth('created_at', today()->subMonth()->month)
                           ->sum('amount');  
                           
         return view('dashboard', compact('todaySales' , 'yesterdaySales', 'thisMonthSales' , 'lastMonthSales'));                  
    }
}
