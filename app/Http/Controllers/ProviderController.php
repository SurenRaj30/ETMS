<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\Models\User;
use App\Models\Provider;
use App\Models\Service;
use App\Models\RegTourist;
use App\Models\Booking;
use App\Models\tempService;
use App\Charts\ServicePerformance;
use App\Notifications\OrderProcessed;
use App\Notifications\ServiceConfirmNotification;
use DataTables;
use DB;
use Auth;

class ProviderController extends Controller
{
   
    public function bookList(Request $request)
    {
       
        if ($request->ajax()) {

            $id = Auth()->user()->id;
            $data = Booking::select('bookings.*')->where('provider_id', $id)->get();

            return Datatables::of($data)

                    ->addIndexColumn()
                    ->editColumn('status', function($data){
                        if($data->status==1){
                            return ' <button class="btn btn-success btn-sm">Accepted</button>';
                        }elseif($data->status==2){
                            return' <button class="btn btn-secondary btn-sm">Pending</button>';
                        }elseif($data->status==3){
                            return' <button class="btn btn-secondary btn-sm">Rejected</button>';
                        }
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="/provider/viewBooking/'.$row->id.'" class="edit btn btn-primary btn-sm mr-3">View</a>';
                           $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';
                           return $btn;
                    })
                    ->rawColumns(['action', 'status'])

                    ->make(true);
        }
        return view('provider.manageBooking.bookList');
    }

    public function viewBooking(Request $request, $id)
    {
        $booking = Booking::join('users', 'bookings.tourist_id', '=', 'users.id')
        ->find($id);

        $book_id = Booking::select('id')->where('id', $id)->first();
       
        return view ('provider.manageBooking.viewBooking', compact('booking', 'book_id'));
    }

    public function accept(Request $request, $id)
    {

        $booking = Booking::join('users', 'bookings.tourist_id', '=', 'users.id')
        ->find($id);
        
        $tourist = User::find($booking->tourist_id);

        $booking->status=2;
        
        $save=$booking->save();
        
        if($save){            
            $details = [

            'greeting' => 'Good Day Tourist',

            'body' => 'Booking for '.$booking->s_name.' have been approved',

            'thanks' => 'Thank you for choosing our service for your holiday activity',

            'actionText' => 'Click here',

            'actionURL' => url('/login'),

            'id' => $tourist->id,

        ];
        Notification::send($tourist, new ServiceConfirmNotification($details));
        return redirect('/provider/bookList')->with('success', 'Booking have been approved');
        }else{
           return back()->with('failed', 'Booking confirmation have failed. Please try again');
        }
            
    }

    public function rejectBooking($id)
    {
        $booking = Booking::find($id);
        return view ('provider.manageBooking.rejectBookingForm', compact('booking'));
    }

    public function processRejectBooking(Request $request, $id)
    {
        
    }

    //manage dashboard

    public function index(){

        $id = Auth::user()->id;

        $serviceRate = Service::all()->where('user_id', $id);
        $pl_service = tempService::select('status', 'ts_name')->where(['user_id' => $id, 'status' => 2])->get();
        
        $reg_service = DB::table('services')->where('user_id', $id)->count();
        $p_service = DB::table('temp_services')->select('status')->where(['status' => 2, 'user_id' => $id])->count();
        $booking = DB::table('bookings')->where('provider_id', $id)->count();

        return view('provider.dashboard', compact('serviceRate', 'reg_service', 'p_service', 'booking', 'pl_service'));
        
    }

    //manage profile crud

    public function profile(){
        $user_id = auth()->user('id');
        $user = Provider::find($user_id)->first();
        return view('provider.profile', compact('user'));
        //return view('provider.profile');
    }

    public function profileUpdateForm(){

        $user_id = auth()->user('id');
        $user = Provider::find($user_id)->first();
        return view ('provider.profileUpdate', compact('user'));
    }

    
    public function profileUpdate(Request $request, $id){

        $user = Provider::find($id)->first();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);

        $update=$user->update();

        if($update){
            return redirect()->route('provider.profile')->with('message', 'Profile Updated');
        }else{
            return back()->with('failed', 'Something went wrong. Please try again');
        }
    }
}
