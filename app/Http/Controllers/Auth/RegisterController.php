<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

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

    //use RegistersUsers;

    /**
     * 
     */
    public function send(RegisterRequest $request)
    {
        $name     = $request->input('name');
        $surnames = $request->input('surnames');
        $email    = $request->input('email');
        $password = $request->input('password');
        $plan     = $request->input('plan');

        $result = DB::select('SELECT email FROM usuario WHERE email = :email', ['email' => $email]);

        if (empty($result)) {
            DB::insert(
                'INSERT INTO usuario (email, password, nombre, apellidos, suscripcion, rol, fecha_alta, fecha_baja) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', 
                [$email, $password, $name, $surnames, $plan, 'user', date('d/m/Y'), '']
            );

            return 'OK';
        } else {
            abort(403, 'Ya existe el usuario registrado!');
        }
    }
}
