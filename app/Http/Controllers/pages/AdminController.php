<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class AdminController extends Controller
{
    /**
     * 
     */
    public function show()
    {
        if (!Session::get('user')) return redirect()->route('login');
        if (Session::get('rol') != 'admin') return redirect()->route('users');
        
        $books = DB::select(
            'SELECT l.id AS id, titulo, a.nombre AS autor, resumen, fecha_publicacion FROM libro_detalle l JOIN autor a ON l.id_autor = a.id ORDER BY l.id DESC'
        );

        $authors = DB::select(
            'SELECT id, nombre FROM autor ORDER BY id DESC'
        );

        $catalogs = DB::select(
            'SELECT id, nombre, idioma FROM catalogo ORDER BY id DESC'
        );

        $params = [
            'script'   => 'js/pnadmin.js',
            'books'    => $books,
            'authors'  => $authors,
            'catalogs' => $catalogs
        ];

        return view('admin', $params);
    }

    /**
     * 
     */
    public function addCatalog(Request $request)
    {
        $name      = $request->input('name');
        $language  = $request->input('language');
        
        DB::insert(
            'INSERT INTO catalogo (nombre, idioma) VALUES (?, ?)', 
            [$name, $language]
        );

        return redirect()->route('admin');
    }

    /**
     * 
     */
    public function changeCatalog(Request $request)
    {
        $id       = $request->input('id');
        $name     = $request->input('name');
        $language = $request->input('language');
        
        DB::update(
            'UPDATE catalogo SET nombre = :nombre, idioma = :idioma WHERE id = :id',
            [
                'nombre' => $name,
                'idioma' => $language,
                'id'     => $id
            ]
        );

        return 'OK!';
    }

    /**
     * 
     */
    public function delCatalog($id)
    {        
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        DB::delete(
            'DELETE FROM catalogo WHERE id = :id', 
            ['id' => $id]
        );

        return redirect()->route('admin');
    }

    /**
     * 
     */
    public function addAuthor(Request $request)
    {
        $name = $request->input('name');
        
        DB::insert(
            'INSERT INTO autor (nombre, imagen) VALUES (?, ?)', 
            [$name, '']
        );

        return redirect()->route('admin');
    }

    /**
     * 
     */
    public function changeAuthor(Request $request)
    {
        $id     = $request->input('id');
        $name   = $request->input('name');
        
        DB::update(
            'UPDATE autor SET nombre = :nombre WHERE id = :id',
            [
                'nombre' => $name,
                'id'     => $id
            ]
        );

        return 'OK!';
    }

    /**
     * 
     */
    public function delAuthor($id)
    {        
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        DB::delete(
            'DELETE FROM autor WHERE id = :id', 
            ['id' => $id]
        );

        return redirect()->route('admin');
    }

    /**
     * 
     */
    public function addBook(Request $request)
    {
        $title       = $request->input('title');
        $author      = $request->input('author');
        $description = $request->input('description');
        
        $nombreIMG = $request->input('nombre-archivo-img');
        $datosIMG  = $request->input('datos-archivo-img');

        $nombrePDF = $request->input('nombre-archivo-pdf');
        $datosPDF  = $request->input('datos-archivo-pdf');

        $extIMG = explode('.', $nombreIMG);
        $extIMG = $extIMG[count($extIMG) - 1];

        $datosIMG = explode(',', $datosIMG);
        $datosIMG = $datosIMG[count($datosIMG) - 1]; //para quitar el mime type

        $extPDF = explode('.', $nombrePDF);
        $extPDF = $extPDF[count($extPDF) - 1];

        $datosPDF = explode(',', $datosPDF);
        $datosPDF = $datosPDF[count($datosPDF) - 1]; //para quitar el mime type

        DB::insert(
            'INSERT INTO libro_detalle (id_libro, id_catalogo, id_autor, idioma, titulo, resumen, fecha_publicacion) VALUES (?, ?, ?, ?, ?, ?, ?)', 
            [5, 1, $author, 'es', $title, $description, date('d/m/Y')]
            //5 y 1 son temporales
        );

        $book = DB::select('SELECT id FROM libro_detalle ORDER BY id DESC');

        mkdir("/books/es/" . ($book[0]->id) . "/", 0777, true);

        $file = fopen("/books/es/" . ($book[0]->id) . "/portada." . $extIMG, "w+");
        fwrite($file, base64_decode($datosIMG));
        fclose($file);

        return redirect()->route('admin');
    }

    /**
     * 
     */
    public function changeBook(Request $request)
    {
        $id          = $request->input('id');
        $title       = $request->input('title');
        $author      = $request->input('author');
        $description = $request->input('description');
        
        DB::update(
            'UPDATE libro_detalle SET titulo = :titulo, resumen = :resumen WHERE id_libro = :id',
            [
                'titulo'   => $title,
                'resumen'  => $description,
                'id'       => $id
            ]
        );

        return 'OK!';
    }

    /**
     * 
     */
    public function delBook($id)
    {        
        if (!Session::get('user')) return redirect()->route('login');
        Session::put('lastURL', $_SERVER['REQUEST_URI']);

        DB::delete(
            'DELETE FROM libro_detalle WHERE id = :id', 
            ['id' => $id]
        );
        return redirect()->route('admin');
    }
}
