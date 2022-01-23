<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Booking;
use Auth;
use DataTables;
use Illuminate\Support\Facades\DB;

class TouristController extends Controller
{
    
    
    public function showProfile()
    {
        return view('tourist.profile');
    }

    //booking functions

    public function bookList(Request $request)
    {
        if ($request->ajax()) {

            $id = Auth()->user()->id;
            $data = Booking::select('bookings.*')->where('tourist_id', $id)->get();

            return Datatables::of($data)

                    ->addIndexColumn()

                    ->editColumn('status', function($data){
                        if($data->status==1){
                            return ' <button class="btn btn-success btn-sm">Accepted</button>';
                        }elseif($data->status==2){
                            return ' <button class="btn btn-secondary btn-sm">Pending</button>';
                        }
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="/tourist/viewBooking/'.$row->id.'" class="edit btn btn-primary btn-sm mr-3">View</a>';
                           $btn = $btn.'<a href="" class="edit btn btn-danger btn-sm">Delete</a>';
                           return $btn;
                    })
                    ->rawColumns(['action', 'status'])

                    ->make(true);
        }
        return view('tourist.bookList');
    }

    public function viewBooking($id)
    {
        // $booking = DB::table('bookings')->where('id', $id)->get();
        $booking = Booking::find($id);
        return view('tourist.bookView', compact('booking'));
    }

    public function deleteBooking($id)
    {
        $delete = Booking::find($id);
        $delete->delete();
        return redirect('tourist/list')->with('success', 'Record deleted succesfully');
    }
}
