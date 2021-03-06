<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tempProvider;
use App\Models\tempService;
use App\Models\Provider;
use App\Models\Service;
use App\Models\User;
use Notification;
use App\Notifications\AccountNotification;
use App\Notifications\ServiceNotification;
use App\Notifications\RejectServiceNotification;
use App\Notifications\RejectAccountNotification;
use DataTables;
use Hash;
use DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        //total number of registered providers and servies
        $t_provider = tempProvider::select('*')->where('status', 1)->count();
        $t_service = tempService::select('*')->where('status', 1)->count();

        //total number of pending providers and services
        $pt_provider = tempProvider::select('*')->where('status', 2)->count();
        $pt_service = tempService::select('*')->where('status', 2)->count();

        //services with rating
        $rating = Provider::join('services', 'services.user_id', '=', 'providers.id' )
                          ->select('services.*', 'providers.name')
                          ->paginate(8);

        return view('admin.dashboard', compact('t_provider', 't_service', 'pt_provider', 'pt_service', 'rating'));
    }
    
    public function pendingList(Request $request)
    {
    
        // $pending=DB::table('temp_providers')->select('*')->paginate(8);
        // return view('admin.pendingList', compact('pending'));
        if ($request->ajax()) {

            $id = Auth()->user()->id;
            $data = tempProvider::select('temp_providers.*')->get();

            return Datatables::of($data)

                    ->addIndexColumn()

                    ->editColumn('status', function($data){
                        if($data->status==1){
                            return '<button class="btn btn-success btn-sm">Accepted</button>';
                        }elseif($data->status==2){
                            return '<button class="btn btn-secondary btn-sm">Pending</button>';
                        }elseif($data->status==3){
                            return '<button class="btn btn-danger btn-sm">Rejected</button>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/viewProvider/'.$row->id.'" class="edit btn btn-primary btn-sm mr-3">View</a>';
                        $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])

                    ->make(true);
        }
        return view('admin.pendingList');
    }

    public function view($id){
        $user = tempProvider::find($id);
        return view('admin.providerView', compact('user'));
    }
    
    public function approve($id, Request $request)
    {
        $data = tempProvider::find($id);

        $data->status = 1;
        
        if($data->status == 1)
        {
            $approve = new Provider;
            $approve->name = $data->name;
            $approve->email = $data->email;
            $approve->password = $data->password;

            //address information
            $approve->street= $data->street;
            $approve->city = $data->city;
            $approve->state = $data->state;
            $approve->postcode= $data->postcode;

            //contact information
            $approve->p_no = $data->p_no;

            //files
            $approve->ic = $data->ic;
            $approve->swa = $data->swa;
            
            $approve->role = 2;  

            $approve->save();
        }
        $save=$data->save();

        $details = [

            'greeting' => 'Good Day Provider',

            'body' => 'Your account have been approved. You can now login and register your service. 
                       Your registered service would also undergo this verification process as well.
                       This is to ensure that the provided service are align with the website terms
                       and conditions. ',

            'thanks' => 'Thank you for using Eco Tourism Setui as your platform to market your service',

            'actionText' => 'Click here',

            'actionURL' => url('/login'),

            'user_id' => $data->id,

        ];
        Notification::send($data, new AccountNotification($details));
        return redirect('/admin/pendingList')->with('success', 'The account have been approved');
    }

    public function rejectForm($id)
    {
        $data = tempProvider::find($id);
        return view('admin.rejectProvider', compact('data'));
    }

    public function processReject(Request $request, $id)
    {
        $data = tempProvider::find($id);
        $id = Auth()->user()->id;
        $user_id = User::find($id);

        $data->status=3;
        $data->reason = $request->reason;

        $data->save();
        $details = [

            'greeting' => 'Good Day Provider',

            'body' => 'We are sorry to inform you that your registration have been rejected. Reason: '.$data->reason.'.',

            'thanks' => 'Please check the information and try registering again',

            'actionText' => 'Click here',

            'actionURL' => url('/login'),

            'id' => $user_id->id,

        ];
        Notification::send($user_id, new RejectAccountNotification($details));
        return redirect('/admin/pendingList')->with('reject', 'Account have been rejected');
        
    }

//manage service
    public function pendingService(Request $request)
    {
        // $pending=DB::table('temp_services')->select('*')->paginate(8);
        // return view('admin.pendingService', compact('pending'));

        if ($request->ajax()) {

            $id = Auth()->user()->id;
            $data = tempService::select('temp_services.*')->get();

            return Datatables::of($data)

                    ->addIndexColumn()

                    ->editColumn('status', function($data){
                        if($data->status==1){
                            return ' <button class="btn btn-success btn-sm">Approved</button>';
                        }elseif($data->status==2){
                            return ' <button class="btn btn-secondary btn-sm">Pending</button>';
                        }elseif($data->status==3){
                            return ' <button class="btn btn-danger btn-sm">Rejected</button>';
                        }
                    })
                    ->addColumn('action', function($row){

                        $btn = '<a href="/admin/viewService/'.$row->ts_id.'" class="edit btn btn-primary btn-sm mr-3">View</a>';
                        $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-success btn-sm mr-3">Edit</a>';
                        $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])

                    ->make(true);
        }
        return view('admin.pendingService');
    }

    public function viewService($ts_id)
    {
        $service = tempService::find($ts_id);
        return view('admin.viewService', compact('service'));
    }

    public function approveService(Request $request, $ts_id)
    {
        $data = tempService::join('providers', 'providers.id', '=', 'temp_services.user_id')
                           ->select('temp_services.*', 'providers.email')
                           ->find($ts_id);

        $data->status = 1;
        if($data->status == 1)
        {
            $approve = new Service;
            $approve->s_category = $data->ts_category;
            $approve->s_name = $data->ts_name;
            $approve->s_price = $data->ts_price;

            $approve->s_address =  $data->ts_address;

            $approve->start_time = $data->start_time;
            $approve->end_time = $data->end_time;

            $approve->s_overview = $data->ts_overview;
            $approve->name=$data->name;
            $approve->image_path=$data->image_path;

            $approve->user_id = $data->user_id;
            $approve->save();
        }
        $data->save();
        
        $details = [

            'greeting' => 'Good Day Provider',

            'body' => 'Your service have been approved.',

            'thanks' => 'Thank you for using Eco Tourism Management System as your platform to market your service',

            'actionText' => 'Click here',

            'actionURL' => url('/login'),

            'ts_id' => $data->ts_id,

        ];
        Notification::send($data, new ServiceNotification($details));

        return redirect('/admin/pendingService')->with('message', 'Service have been approved');
    }

    public function showRejectForm($ts_id)
    {
        $data = tempService::find($ts_id);
        return view('admin.rejectForm', compact('data'));
    }

    public function processRejectForm(Request $request, $ts_id)
    {
        $data = tempService::find($ts_id);
        $id = Auth()->user()->id;
        $user_id = User::find($id);

        $data->status=3;
        $data->reason = $request->reason;

        $data->save();
        $details = [

            'greeting' => 'Good Day Provider',

            'body' => 'We are sorry to inform you that your service have been rejected. '.$data->reason.'.',

            'thanks' => 'Please check the information and try registering the service again',

            'actionText' => 'Click here',

            'actionURL' => url('/login'),

            'id' => $user_id->id,

        ];
        Notification::send($user_id, new RejectServiceNotification($details));
        return redirect('/pendingService')->with('reject', 'Service have been rejected');
        
    }

}
