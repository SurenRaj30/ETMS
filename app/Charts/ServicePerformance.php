<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Provider;
use Auth;

class ServicePerformance extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        return Chartisan::build()
            ->labels(['First', 'Second', 'Third'])
            ->dataset('Sample', [1, 2, 3])
            ->dataset('Sample 2', [3, 2, 1]);
    }

    public function index(){
        $id = Auth::user()->id;
        // $tourist = DB::table('reg_tourists')->where('user_id', $id)->count();
        // $service = DB::table('services')->where('user_id', $id)->count();

        $test = Service::all();
        
        $chart = new ServicePerformance;

        $chart->labels(['One', 'Two', 'Three', 'Four']);
        $chart->dataset(['My dataset 1', 'line', [1,2,3,4]]);

        return view('provider.dashboard', compact('chart'));

        
        //return view('provider.dashboard');
    }
}