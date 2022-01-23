<?php

namespace App\Http\Controllers\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\tempService;
use App\Models\Provider;
use App\Models\User;
use DataTables;
use Auth;
use Route;
use DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // $user_id = auth()->user()->id;
        // $user = DB::table('services')->select('*')->where('user_id', $user_id)->paginate(8);
        // return view('provider.manageService.regServiceList', compact('user'));

        if ($request->ajax()) {

            $id = Auth()->user()->id;
            $data = Service::select('services.*')->where('user_id', $id)->get();

            return Datatables::of($data)

                    ->addIndexColumn()

                    ->addColumn('action', function($row){
                           $btn = '<a href="/provider/show/'.$row->s_id.'" class="edit btn btn-primary btn-sm mr-3">View</a>';
                           $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-success btn-sm mr-3">Edit</a>';
                           $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';
                           return $btn;
                    })
                    ->rawColumns(['action'])

                    ->make(true);
        }
        return view('provider.manageService.regServiceList');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provider.manageService.registerServiceForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            's_name'=>'required|unique:services',
            's_price'=>'required',
            's_overview'=>'required',
        ]);

        $service = new tempService();
        $service->ts_name = $request->s_name;
        $service->ts_category = $request->s_category;
        $service->ts_price = $request->s_price;
        $service->ts_address = $request->s_address;
        $service->ts_overview = $request->s_overview;
        $service->status = 2;
        $service ->user_id = Auth::guard('s_provider')->id();

        $service->start_time = $request->start_time;
        $service->end_time = $request->end_time;

        //inserting multiple images

        if($request->hasFile('imageFile')){

            foreach($request->file('imageFile') as $file)
            {   
                $name = $file->getClientOriginalName();

                $file->move('uploads/serviceImages', $name);  	

                $data[] = $name;  
            }
    }
    
    $service->name=json_encode($data);
    $service->image_path=json_encode($data);
    
    $save=$service->save();
    
        if($save){
            return redirect('/provider/serviceList')
            ->with('message', 'Service registered successfully for admin approval');
        }else{
            return redirect()->back()
            ->with('failed', 'Something went wrong, Please register service again');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($s_id)
    {
        $service = Service::find($s_id);
        $route = Route::current()->getName();
        return view('provider.manageService.regServiceShow', compact('route'))->with('service', $service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($s_id)
    {
        $service = Service::find($s_id);
        $route = Route::current()->getName();
        return view('provider.manageService.regServiceShow', compact('route'))->with('service', $service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $s_id)
    {
        
        $request->validate([
            's_category'=>'required',
            's_name'=>'required|unique:services',
            's_price'=>'required',
            's_overview'=>'required',
        ]);

       $update = Service::find($s_id);

        $update->s_category = $request->s_category;
        $update->s_name = $request->s_name;
        $update->s_price = $request->s_price;
        $update->s_overview = $request->s_overview;

        $save=$update->update();

        if($save)
        {
            return redirect()->route('regServiceShow')
            ->with('success', 'Service details updated successfully');
        }else{
            return back()->with('failed', 'Something went wrong. Please try again');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($s_id)
    {
        $delete = Service::where('s_id', $s_id)->firstorfail()->delete();
        return redirect()->route('serviceList')->with('deleted', 'Record deleted');
    }

    
}
