<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating;
use DB;
use Auth;

class SampleChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
       
        // $service = DB::table('ratings')->pluck('rating');
        
        // $name = DB::table('services')->pluck('s_name');
        // $service = DB::table('ratings')->pluck('rating');

        // $tjoin = Service::join('ratings', 'services.s_id', '=', 'ratings.rateable_id')
        // ->pluck('rating', 's_name');

        // $average = DB::table('ratings')
        // ->join('services', 'ratings.rateable_id', '=', 'services.s_id')
        // ->pluck('rating');

        $average = DB::table('ratings')
        ->join('services', 'ratings.rateable_id', '=', 'services.s_id')
        ->select(DB::raw('avg(rating)'),'s_name')
        ->groupBy('s_name')->get();

        $average->pluck('s_name');

        
        return Chartisan::build()
            ->labels([$average->toArray()])
            ->dataset('Sample', ['1', '2']);
    }
}