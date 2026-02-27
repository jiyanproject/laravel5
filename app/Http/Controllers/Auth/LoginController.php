<?php

namespace iteos\Http\Controllers\Auth;

use iteos\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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
    protected $redirectTo = '/apps/user-dashboard';
    public function redirectTo(){
    $role = Auth::user()->email; 
        switch ($role) {
            case 'heru.palomino@gmail.com':
                    return '/apps/configuration';
                break;
            default:
                    return '/apps/user-dashboard'; 
                break;
        }
    }
    /*public function redirectTo()
    {
        if ((Auth::user()->is_first_login == '1')) {
            return redirect()->route('changePass.index');
        } else {
            return redirect()->route('userHome.index');
        }
    }*/
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
        return view('apps.pages.login');
    }
}
