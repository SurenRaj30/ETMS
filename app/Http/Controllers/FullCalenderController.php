<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Service;
use DB;

class FullCalenderController extends Controller

{

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function index(Request $request, $s_id)

    {
        
        $service = Service::find($s_id);

        $events = Booking::select('title', 'start', 'end')->where('title', $service->s_name)->get();

        $event = [];

        foreach($events as $row)
        {
            $event[] = \Calendar::event(
                $row->title,
                true,
                $row->start,
                $row->end,
            );
        }
        $calendar = \Calendar::addEvents($event);
        return view('fullcalender', compact('events', 'calendar'));
    }


    /**

     * Write code on Method

     *

     * @return response()

     */

    public function ajax(Request $request)

    {

 

        switch ($request->type) {

           case 'add':

              $event = Booking::create([

                  's_name' => $request->s_name,

                  'start' => $request->start,

                  'end' => $request->end,

              ]);

 

              return response()->json($event);

             break;

  

           case 'update':

              $event = Event::find($request->id)->update([

                   's_name' => $request->s_name,

                  'start' => $request->start,

                  'end' => $request->end,

              ]);

 

              return response()->json($event);

             break;

  

           case 'delete':

              $event = Event::find($request->id)->delete();

  

              return response()->json($event);

             break;

             

           default:

             # code...

             break;

        }

    }

}