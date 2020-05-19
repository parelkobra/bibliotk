<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->guest('login');
});

// Login sin autentificar
Route::get('login', 'Auth\LoginController@show')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login-post');

// Logout
Route::get('logout/{message?}', 'Auth\LoginController@logout')->name('logout');

// Idiomas
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, Config::get('app.locales'))) {
        Session::put('locale', $locale);
    }

    return redirect()->back();
});

// Registro usuario
Route::post('register', 'Auth\RegisterController@send')->name('register');

//Cambio de contraseña
Route::post('cambiar-password', 'Auth\ForgotPasswordController@update')->name('cambiar-password');

//Actualizar perfil usuario
Route::post('update-profile', 'Pages\UsersController@changeProfile')->name('update-profile');

// Search not finished
Route::get('search', 'Pages\HomeController@search')->name('search');

// Paginas solo accesibles con session
Route::get('users', 'Pages\UsersController@show')->name('users');
Route::get('select-profile/{id}', 'Pages\HomeController@selectProfile')->name('select-profile');

Route::get('home', 'Pages\HomeController@show')->name('home');
Route::get('mylist', 'Pages\HomeController@showMyList')->name('my-list');
Route::get('catalog', 'Pages\HomeController@showCatalog')->name('catalog');
Route::get('alphabetic', 'Pages\HomeController@showAlphabetic')->name('alphabetic');
Route::get('author', 'Pages\HomeController@showAuthor')->name('author');

Route::get('book/{id}', 'Pages\BookController@show')->name('book');
Route::get('add-list/{id}', 'Pages\BookController@addList')->name('add-list');
Route::get('del-list/{id}', 'Pages\BookController@delList')->name('del-list');

Route::post('add-book', 'Pages\AdminController@addBook')->name('add-book');
Route::post('edit-book', 'Pages\AdminController@changeBook')->name('edit-book');
Route::get('del-book/{id}', 'Pages\AdminController@delBook')->name('del-book');

Route::post('add-author', 'Pages\AdminController@addAuthor')->name('add-author');
Route::post('edit-author', 'Pages\AdminController@changeAuthor')->name('edit-author');
Route::get('del-author/{id}', 'Pages\AdminController@delAuthor')->name('del-author');

Route::post('add-catalog', 'Pages\AdminController@addCatalog')->name('add-catalog');
Route::post('edit-catalog', 'Pages\AdminController@changeCatalog')->name('edit-catalog');
Route::get('del-catalog/{id}', 'Pages\AdminController@delCatalog')->name('del-catalog');

// Volver a la ultima pagina visitada
Route::get('back', function () {
    return redirect(Session::get('lastURL'));
});

// Panel de administracion de libros y autores
Route::get('admin', 'Pages\AdminController@show')->name('admin');

