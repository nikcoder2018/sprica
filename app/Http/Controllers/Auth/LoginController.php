<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Validator;
use App\Helpers\Language;
use App\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $data['admin_log_desc'] = Language::settings('Admin_Giris_Yap_Aciklama');
        $data['placeholder']['username'] = Language::settings('Kullanici_Adiniz');
        $data['placeholder']['password'] = Language::settings('Giris_Sifreniz');
        $data['btn_submit_title'] = Language::settings('Giris_Yap_btn');

        return view('auth.login', $data);
    }

    public function username(){
        return 'username';
    }

    public function login(Request $request)
    {
        $remember_me  = ( !empty( $request->remember_me ) )? TRUE : FALSE;

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1],$remember_me)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }

        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();

        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if ($user && \Hash::check($request->password, $user->password) && $user->status != 1) {
            $errors = [$this->username() => trans('auth.notactive')];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    } 
}
