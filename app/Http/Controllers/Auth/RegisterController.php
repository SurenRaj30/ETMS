<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Provider;
use App\Models\tempProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'number' => $data['number'],
            'password' => Hash::make($data['password']),
            'role'=>3,
        ]);
    }

    
    protected function providerForm()
    {
        return view('auth.registerProvider', ['url' => 's_provider']);
    }
    
    protected function createProvider(request $request)
    {

        $provider = new tempProvider;

        //validator
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:temp_providers',
            'password'=> 'required',
            'street' => 'required',
            'city' => 'required',
            'p_no' => 'required',
            'ic' => 'required',
            'swa' => 'required',
        ]);
    
        //profile information
        $provider->name = $request->name;
        $provider->email = $request->email;
        $provider->password = Hash::make($request->password);
        
       
        //address information
        $provider->street = $request->street;
        $provider->city = $request->city;
        $provider->state= $request->state;
        $provider->postcode= $request->postcode;
       
        //contact information
        $provider->p_no=$request->p_no;

        //files
        if($request->hasFile('ic')){
            $fileIC = time().'_'.$request->ic->getClientOriginalName();
            $file_ic->move('uploads/serviceImages', $filename);
        }

        if($request->hasFile('swa')){
            $fileSwa= time().'_'.$request->swa->getClientOriginalName();
            $file_swa->move('uploads/serviceImages', $fileSwa);
        }

        $provider->ic=$request->ic;
        $provider->swa=$request->swa;

        //intial approval status
        $provider->status = false;

        $provider->save();
        return redirect('login/s_provider')->with('success', 'Your registration was successful and do wait for admin approval');
       

     
    }

  
}
