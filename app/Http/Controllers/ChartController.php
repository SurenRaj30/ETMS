<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use App\Models\User;
use App\Models\Booking;
use DB;
use Auth;

class ChartController extends Controller
{
    public function _invoke()
    {
       
       //$month = User::select('name')->whereMonth('created_at', 1);


       $id = Auth::user()->id;
       $x = Booking::select('s_name')->where('provider_id', $id)->get();
       $y = Booking::select('s_name')->where('provider_id', $id)->groupBy($x);

       $chart = Chartisan::build()
       ->labels(['Service'])
       ->dataset([$y]);
        return view('chart', compact('chart'));
    }
}
