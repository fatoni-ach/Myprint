<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'ProdukController@index')->name('produk');
Route::get('/sort', 'ProdukController@index')->name('produk.sort');
Route::get('/l', 'LoginController@login')->name('login');
Route::post('/l', 'LoginController@login')->name('login');

Route::middleware('auth')->group(function ()
{
    Route::get('/produk', 'ProdukController@produk_admin')->name('produk.admin');
    Route::get('/produk/create', 'ProdukController@create')->name('create.produk');
    Route::post('/produk/create', 'ProdukController@create')->name('create.produk');
    Route::get('/produk/{produk:slug}/show', 'ProdukController@show')->name('show.produk');
    Route::get('/produk/{produk:slug}/edit', 'ProdukController@edit')->name('edit.produk');
    Route::post('/produk/{produk:slug}/edit', 'ProdukController@edit')->name('edit.produk');
    Route::get('/produk/{produk:slug}/delete', 'ProdukController@delete')->name('delete.produk');
    Route::get('/produk/kategori/{kategori:id}', 'ProdukController@kategori_admin')->name('produk.kategori.admin');
    Route::get('/search/admin', 'SearchController@produk_admin')->name('search.produk.admin');

    Route::get('/kategori', 'KategoriController@kategori')->name('kategori');
    Route::post('/kategori/create', 'KategoriController@create')->name('kategori.create');
    Route::put('/kategori/delete', 'KategoriController@delete')->name('kategori.delete');
    Route::post('/kategori/update', 'KategoriController@update')->name('kategori.update');

    Route::get('/profil', 'ProfilController@profil')->name('profil');
    Route::post('/profil', 'ProfilController@profil')->name('profil');
    Route::post('/profil/update', 'ProfilController@update')->name('profil.update');

    Route::get('/promo', 'PromoController@promo')->name('promo');
    Route::post('/promo/create', 'PromoController@create')->name('promo.create');
    Route::post('/promo/delete', 'PromoController@delete')->name('promo.delete');
    Route::post('/promo/update', 'PromoController@update')->name('promo.update');

    Route::post('/gambar/create', 'GambarController@create')->name('gambar.tambah');
    Route::get('/gambar/delete', 'GambarController@delete')->name('gambar.delete');
});

Route::get('/logout/admin', 'LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/kategori/{kategori:id}', 'ProdukController@kategori')->name('produk.kategori');
Route::get('/kategori/{kategori:id}/sort', 'ProdukController@kategori')->name('produk.kategori.sort');
Route::get('/produk/{produk:slug}', 'ProdukController@show_produk')->name('show');
Route::get('/search', 'SearchController@produk')->name('search.produk');