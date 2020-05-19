<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function update(Request $request)
    {
        //Generación de contraseña aleatoria
        $keyLength = 8;
        $str = "1234567890abcdefghijklmnopqrstuvwxyz";
        $randStr = substr(str_shuffle($str), 0, $keyLength); 

        $email = $request->input('email');

        $result = DB::select('SELECT email FROM usuario WHERE email = :email', ['email' => $email]);

        if (empty($result)) {
            DB::update('update usuario set password = :newPassword where email = :email', ['newPassword' => $randStr, 'email' => $email]);
            return 'OK';
        } else {
            abort(403, 'No se ha podido cambiar la contraseña...');
        }
        
        return redirect()->route('login');
    }
}
