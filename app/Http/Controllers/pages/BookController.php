<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class BookController extends Controller
{
    /**
     * 
     */
    public function show($id)
    {
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        $book = DB::select(
            'SELECT l.id AS id, titulo, resumen, a.nombre AS autor FROM libro_detalle l JOIN autor a ON l.id_autor = a.id WHERE id_libro = :id',
            ['id' => $id]
        );

        $mylist = DB::select(
            'SELECT id FROM perfil_lista WHERE id_perfil = :perfil AND id_libro = :id',
            [
                'perfil' => Session::get('profile-id'),
                'id'     => $id
            ]
        );

        $inlist = (empty($mylist)) ? false : true;

        $params = [
            'script' => 'js/book.js',
            'book'   => $book[0],
            'inlist' => $inlist
        ];

        return view('book', $params);
    }

    /**
     * 
     */
    public function addList($id)
    {
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        DB::insert(
            'INSERT INTO perfil_lista (id_perfil, id_libro) VALUES (?, ?)', 
            [Session::get('profile-id'), $id]
        );

        return redirect('book/' . $id);
    }

    /**
     * 
     */
    public function delList($id)
    {
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        DB::delete(
            'DELETE FROM perfil_lista WHERE id_perfil = :perfil AND id_libro = :id', 
            [
                'perfil' => Session::get('profile-id'),
                'id'     => $id
            ]
        );

        return redirect('book/' . $id);
    }
}
