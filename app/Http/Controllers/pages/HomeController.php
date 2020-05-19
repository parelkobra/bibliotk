<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class HomeController extends Controller
{
    /**
     * 
     */
    public function show()
    {
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        $books = DB::select(
            'SELECT l.id AS id, titulo, a.nombre AS autor FROM libro_detalle l JOIN autor a ON l.id_autor = a.id ORDER BY l.id DESC LIMIT 4'
        );

        $mylist = DB::select(
            'SELECT l.id AS id, titulo, a.nombre AS autor FROM libro_detalle l JOIN autor a ON l.id_autor = a.id JOIN perfil_lista p ON p.id_libro = l.id WHERE p.id_perfil = :id ORDER BY l.id DESC LIMIT 4',
            ['id' => Session::get('profile-id')]
        );
        
        $params = [
            'script'      => 'js/home.js',
            'books'       => $books,
            'mylist'      => $mylist,
            'section'     => 'home',
        ];

        return view('home', $params);
    }

    /**
     * 
     */
    public function search(Request $request)
    {
        $title = $request->input('title');
        // $author = $request->input('author');
        // $language = $request->input('language');
        // $catalog = $request->input('catalog');

        $result = DB::table('libro_detalle as l')
                    ->join('autor as a', 'l.id_autor', '=', 'a.id')
                    ->select(['l.id AS id', 'titulo', 'a.nombre AS autor'])
                    ->where('titulo','LIKE','%'.$title.'%')
                    ->get();

        if (empty($result)) 
        {
            abort(403, 'No se ha encontrado el libro.');
        }
        else
        {
            //QUE ME DEVUELVA EL LIBRO (EN CODIGO HTML INCLUSO)

            return view('search-result', $result);

        }

    }

    /**
     * 
     */
    public function showMyList() 
    {
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        $mylist = DB::select(
            'SELECT l.id AS id, titulo, a.nombre AS autor FROM libro_detalle l JOIN autor a ON l.id_autor = a.id JOIN perfil_lista p ON p.id_libro = l.id WHERE p.id_perfil = :id ORDER BY l.id DESC',
            ['id' => Session::get('profile-id')]
        );

        $params = [
            'script'  => 'js/home.js',
            'mylist'  => $mylist,
            'section' => 'mylist'
        ];

        return view('home', $params);
    }

    /**
     * 
     */
    public function showCatalog() 
    {
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        $books = DB::table('libro_detalle as l')
                    ->join('autor as a', 'l.id_autor', '=', 'a.id')
                    ->join('catalogo as c','l.id_catalogo','=','c.id')
                    ->select(['l.id AS id','titulo','a.nombre AS autor','c.nombre AS catalogoNombre'])
                    ->orderBy('c.id','asc')
                    ->paginate(8); 

        $i = 0;
        foreach($books as $book) {
            $i ++;
            $catalog = $book->catalogoNombre;
            $result[$catalog][$i]['id'] = $book->id;
            $result[$catalog][$i]['titulo'] = $book->titulo;
            $result[$catalog][$i]['autor'] = $book->autor;
        }

        $params = [
            'script'  => 'js/home.js',
            'groups'  => $result,
            'section' => 'catalog'
        ];
    
        return view('home', $params);
    }

    /**
     * 
     */
    public function showAlphabetic() 
    {
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        $books = DB::table('libro_detalle as l')
                    ->join('autor as a', 'l.id_autor', '=', 'a.id')
                    ->select(['l.id AS id','titulo','a.nombre AS autor'])
                    ->orderBy('l.titulo','asc')
                    ->paginate(8); 

        $i = 0;
        foreach($books as $book) {
            $i ++;
            $title = $book->titulo;
            $current_letter = substr($title, 0, 1);
            $result[$current_letter][$i]['id'] = $book->id;
            $result[$current_letter][$i]['titulo'] = $title;
            $result[$current_letter][$i]['autor'] = $book->autor;
        }

        $params = [
            'script'  => 'js/home.js',
            'groups'  => $result,
            'section' => 'alphabetic'
        ];
    
        return view('home', $params);
    }

    /**
     * 
     */
    public function showAuthor() 
    {
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        $books = DB::table('libro_detalle as l')
                    ->join('autor as a', 'l.id_autor', '=', 'a.id')
                    ->select(['l.id AS id','titulo','a.nombre AS autor'])
                    ->orderBy('a.nombre','asc')
                    ->paginate(6); 

        $i = 0;
        foreach($books as $book) {
            $i ++;
            $author = $book->autor;
            $result[$author][$i]['id'] = $book->id;
            $result[$author][$i]['titulo'] = $book->titulo;
            $result[$author][$i]['autor'] = $author;
        }

        $params = [
            'script'  => 'js/home.js',
            'groups'  => $result,
            'section' => 'author'
        ];
    
        return view('home', $params);
    }

    /**
     * 
     */
    public function selectProfile($id = 0)
    {
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        $profile = DB::select(
            'SELECT id, nombre FROM usuario_perfil WHERE id = :id AND id_usuario = :user',
            ['id' => $id, 'user' => Session::get('id')]
        );

        if (empty($profile)) {

            return redirect()->route('users')->with('error', 'error');

        } else {

            Session::put('profile', $profile[0]->nombre);
            Session::put('profile-id', $profile[0]->id);

            return redirect()->route('home');
        }
    }
}
