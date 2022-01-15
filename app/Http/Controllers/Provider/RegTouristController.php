<?php

namespace App\Http\Controllers\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegTourist;
use App\Models\Service;
use App\Models\Provider;
use URL;
use Route;
use Auth;
use DB;

class RegTouristController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //testing search

   

    public function index()
    { 
        $id = Auth::user()->id;
        $user = Provider::find($id);

        $s_name = DB::table('providers')->select('services.s_name')
                                      ->join('services', 'providers.id', 'services.user_id')
                                      ->join('reg_tourists', 'providers.id', 'reg_tourists.user_id')
                                      ->get()->implode('s_name');

        return view('provider.manageTourist.regTouristList', compact('s_name'))
        ->with('RegTourists', $user->RegTourists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user('id');
        $user = Provider::find($user_id)->first();
        return view('provider.manageTourist.touristRegister')->with('services', $user->services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $regTourist = new RegTourist;

        $regTourist->rt_name = $request->rt_name;
        $regTourist->rt_contact = $request->rt_contact;
        $regTourist->start_date = $request->start_date;
        $regTourist->end_date = $request->end_date;
        $regTourist->c_package = $request->c_package;
        $regTourist ->user_id = Auth()->user()->id;
      
        $save =$regTourist->save();

        if($save){
            return redirect()->route('touristList')
            ->with('success', 'You have successfully registered a new tourist');
        }else{
            return redirect()->back()
            ->with('fail', 'Failed to register the tourist');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($rt_id)
    {
       $list = RegTourist::find($rt_id);
       $route = Route::current()->getName();
       return view('provider.manageTourist.regTouristShow', compact('route'))->with('list', $list);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($rt_id)
    {
       $list = RegTourist::find($rt_id);
       $route = Route::current()->getName();
       return view('provider.manageTourist.regTouristShow', compact('route'))->with('list', $list);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rt_id)
    {
        $update = RegTourist::find($rt_id);
        
        $update->rt_name = $request->rt_name;
        $update->rt_contact = $request->rt_contact;
        $update->start_date = $request->start_date;
        $update->end_date = $request->end_date;
        $update->c_package = $request->c_package;

        $update->save();

        return redirect()->route('touristList');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rt_id)
    {
        $delete = RegTourist::where('rt_id',$rt_id)->firstorfail()->delete();
        return redirect()->route('provider.touristList')->with('success', 'Record deleted');
    }
}
