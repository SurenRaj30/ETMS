<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking;
use App\Models\User;
use App\Models\Rating;
use URL;
use Auth;
use DB;
use Session;
use Stripe;

class BookingController extends Controller
{
    public function form($s_id)
    {
        //$service = Service::all();
        $user_id = Auth()->user()->id;
        $service = Service::find($s_id);
        $user = User::find($user_id);
        return view('tourist.bookForm', compact('service', 'user'));
    }

    public function create(Request $request)
    {
        
        $booking = new Booking();

        $b_service = Service::find($request->service_id);

        $dates = Booking::select('start', 'end')->where('title', $b_service->s_name)->get();

        $booking->s_name = $request->s_name;
        $booking->s_category = $request->s_category;
        $booking->title= $request->s_name;
        $booking->no_tourist = $request->no_tourist;
        $booking->totalPrice = ($request->no_tourist)*($request->totalPrice);
        $booking->depositPrice = $request->depositPrice;
        $booking->start = $request->start_date;
        $booking->end = $request->end_date;
        $booking->tourist_id = Auth::user()->id;
        $booking->provider_id = $request->provider_id;
        $booking->title = $request->s_name;
        $booking->status = 1;

        foreach($dates as $row)
        {
            if($row->start==$request->start_date){
                if($row->end==$request->end_date){
                    return back()->with('sameDate', 'The chosen date is booked. Please choose another 
                    booking date.');
                }
            }
        }
        return view('paymentGate.stripe', compact('booking'));

    }

    public function main()
    {
       
        $service = Service::all();
        return view('tourist.main', compact('service'));
    }

    public function list()
    {
        $id = Auth::id();
        $list = DB::table('bookings')->where('tourist_id', $id)->get();
        return view('tourist.dashboard', compact('list'));
    }

    public function view($s_id)
    {
        $service = Service::find($s_id);
        return view('tourist.view', compact('service'));
    }

    //submit service rating

    public function rating(Request $request)
    {
        request()->validate(['rate' => 'required']);

        $service = Service::find($request->id); //refers to the service id

        $rating = new \willvincent\Rateable\Rating;

        $rating->rating = $request->rate;

        $rating->user_id = auth()->user()->id; //refers to auth tourist id

        $service->ratings()->save($rating);

        return redirect('/tourist/main');
    }
}
