<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    // protected function redirectTo(){
    //     if(Auth()->user()==1){
    //         return route('admin.dashboard');
    //     }
    //     elseif(Auth()->user()==2){
    //         return route('provider.dashboard');
    //     }
    //     elseif(Auth()->user()==3){
    //         return route('tourist.dashboard');
    //     }
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:s_provider')->except('logout');
    }

    ///overide the default login auth

    public function login(request $request){

        $request->validate([

            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:3|max:12',
        ]);
        
        $creds = $request->only('email', 'password');
        
        if(Auth::attempt($creds)){
            if(Auth()->user()->role==1){
                Session::put('logged', Auth()->user()->id);
                return redirect()->route('admin.dashboard');
            }elseif(Auth()->user()->role==2){
                Session::put('logged', Auth()->user()->id);
                //$id = Auth()->user()->id;
                return redirect()->route('provider.dashboard');
            }elseif(Auth()->user()->role==3){
                Session::put('logged', Auth()->user()->id);
                return redirect('tourist/main');
            }
        }else{
            return redirect()->route('login')->with('fail', 'Wrong password');

        }

    }

    public function providerLoginForm()
    {
        return view('auth.login', ['url' => 's_provider']);
    }
    
    public function providerLogin(request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:3'
        ]);

        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];


$credentials = Auth::guard('s_provider')->attempt(['email'=> $request->email, 'password' => $request->password]);
        if($credentials)
        {
            return redirect()->route('provider.dashboard');
        }else{
           return redirect()->route('providerLoginForm');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

   
}
