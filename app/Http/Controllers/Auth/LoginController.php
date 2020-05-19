<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /** 
     *  
     */
    public function show()
    {
        $params = ['script' => 'js/login.js'];

        return view('forms/login', $params);
    }

    /**
     * 
     */
    public function login(LoginRequest $request)
    {
        $email    = trim($request->input('email'));
        $password = $request->input('password');
        $remember = empty($request->input('remember')) ? false : true;

        $result = DB::select(
            'SELECT email, rol FROM usuario WHERE email = :email AND password = :password', 
            [
                'email'     => $email,
                'password'  => $password
            ]
        );

        if (!empty($result)) {
            Session::put('user', $email);
            Session::put('rol', $result[0]->rol);

            return redirect()->guest('users');
        } else {
            return redirect()->route('login')->with('error', 'error');
        }
    }

    /**
     * Expulsa al usuario de la aplicación, redirigiéndolo al login.
     * Puede mostrar un mensaje de error.
     *
     * @param string $message Mensaje de error o advertencia
     * @return type
     */
    public static function logout($message = null)
    {
        Session::flush();
        return redirect()->route('login')->with('error', $message);
    }

}
