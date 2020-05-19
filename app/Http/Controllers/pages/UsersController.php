<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class UsersController extends Controller
{
    /**
     * 
     */
    public function show()
    {
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        $user = DB::select(
            'SELECT id, suscripcion FROM usuario WHERE email = :email', 
            ['email' => Session::get('user')]
        );
        
        Session::put('id', $user[0]->id);

        $profiles = DB::select(
            'SELECT id, nombre, imagen, color FROM usuario_perfil WHERE id_usuario = :id', 
            ['id' => $user[0]->id]
        );

        if (empty($profiles)) {
            if ($user[0]->suscripcion == 3) { //cuenta de 4 perfiles
                $length = 4;
            } else { //cuenta de 2 perfiles
                $length = 2;
            }

            for ($i = 0; $i < $length; $i++) {
                DB::insert(
                    'INSERT INTO usuario_perfil (id_usuario, nombre, imagen, color) VALUES (?, ?, ?, ?)', 
                    [$user[0]->id, 'Perfil ' . ($i + 1), '0', rand(0, 360)]
                );
            }

            $profiles = DB::select(
                'SELECT id, nombre, imagen, color FROM usuario_perfil WHERE id_usuario = :id', 
                ['id' => $user[0]->id]
            );
        }

        $params = [
            'script'   => 'js/users.js',
            'plan'     => $user[0]->suscripcion,
            'profiles' => $profiles
        ];

        return view('users', $params);
    }

    /**
     * 
     */
    public function changeProfile(Request $request)
    {
        $id     = $request->input('id');
        $name   = $request->input('name');
        $imagen = $request->input('image');
        $color  = $request->input('color');
        
        DB::update(
            'update usuario_perfil set nombre = :nombre, imagen = :imagen, color = :color where id = :id',
            [
                'nombre' => $name,
                'imagen' => $imagen,
                'color'  => $color,
                'id'     => $id
            ]
        );

        return 'OK!';
    }
}