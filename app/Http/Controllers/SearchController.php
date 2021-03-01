<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Produk, Promo, Kategori, Profil};

class SearchController extends Controller
{
    public function produk(Request $request)
    {
        $promo = Promo::latest()->get();
        $profil = Profil::get()->first();
        $produk_all = Produk::get();
        $search = strtolower($request['search']);
        $produk = Produk::whereRaw('lower(nama) like (?)',["%{$search}%"])->latest()->paginate(3);
        if(isset($request['sort'])){
            $sorted = $request['sort'];
        } else {
            $sorted = null;
        }
        // whereRaw("UPPER('{$column}') LIKE '%'". strtoupper($value)."'%'"); 
        // dd($produk);
        $kategori = Kategori::get()->sortBy('id');
        return view('newproduk', compact('produk', 'profil', 'kategori', 'promo', 'produk_all', 'search', 'sorted'));
    }

    public function produk_admin(Request $request)
    {
        $produk_all = Produk::get();
        $search = $request['search'];
        $produk = Produk::whereRaw('lower(nama) like (?)',["%{$search}%"])->latest()->paginate(3);
        // dd($produk);
        $kategori = Kategori::get()->sortBy('id');
        return view('admin.produk_admin', compact('produk', 'kategori', 'produk_all', 'search'));
    }
}
