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
        $search = $request['search'];
        $produk = Produk::where('nama', 'ilike', "%$search%")->latest()->paginate(3);
        // dd($produk);
        $kategori = Kategori::get()->sortBy('id');
        return view('produk', compact('produk', 'profil', 'kategori', 'promo', 'produk_all', 'search'));
    }

    public function produk_admin(Request $request)
    {
        $produk_all = Produk::get();
        $search = $request['search'];
        $produk = Produk::where('nama', 'ilike', "%$search%")->latest()->paginate(3);
        // dd($produk);
        $kategori = Kategori::get()->sortBy('id');
        return view('admin.produk_admin', compact('produk', 'kategori', 'produk_all', 'search'));
    }
}
