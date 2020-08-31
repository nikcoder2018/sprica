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
}
