<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Produk, Kategori, GambarProduk, Profil, Promo};

class ProdukController extends Controller
{
    
    public function index()
    {   
        $promo = Promo::latest()->get();
        $profil = Profil::get()->first();
        $produk_all = Produk::get();
        $produk = Produk::inRandomOrder()->paginate(6);
        $kategori = Kategori::get()->sortBy('id');
        // $url_wa = "https://api.whatsapp.com/send?phone=".$profil->no_wa;
        return view('produk', compact('produk', 'profil', 'kategori', 'promo', 'produk_all'));
    }

    public function produk_admin(Produk $produk, GambarProduk $gambarProduk)
    {
        $kategori = Kategori::get()->sortBy('id');
        $produk = Produk::latest()->paginate(6);
        return view('admin.produk_admin', compact('produk', 'kategori'));
    }

    public function kategori(Kategori $kategori)
    {   
        $profil = Profil::get()->first();
        $promo = Promo::latest()->get();
        $produk = Produk::where('kategori_id', $kategori->id)->paginate(6);
        $produk_all = Produk::get();
        $k_aktif = $kategori;
        $kategori = Kategori::get()->sortBy('id');
        $url_wa = "https://api.whatsapp.com/send?phone=".$profil->no_wa;
        return view('produk', compact('produk', 'profil', 'kategori', 'k_aktif', 'promo', 'produk_all', 'url_wa'));
    }

    public function kategori_admin(Kategori $kategori)
    {   
        
        $produk = Produk::where('kategori_id', $kategori->id)->paginate(6);
        $produk_all = Produk::get();
        $k_aktif = $kategori;
        $kategori = Kategori::get()->sortBy('id');
        $profil = Profil::get()->first();
        return view('admin.produk_admin', compact('produk', 'kategori', 'k_aktif', 'produk_all'));
    }

    public function create(Request $request, Kategori $kategori)
    {   
        if($request->method() == "POST"){
            // dd($request);
            $slug = \Str::slug($request['nama']);
            if (file_exists(request()->file('gambar'))){
                $thumbnail = request()->file('gambar');
                $thumbnailUrl = $thumbnail->store("public/images/produks");
                $thumbnailUrl = preg_replace("/public/i", "", $thumbnailUrl );
            } else {
                $thumbnailUrl = "";
            }
            $produk = Produk::create([
                'nama' => $request['nama'],
                'slug'  => $slug,
                'deskripsi' => $request['deskripsi'],
                'harga' => $request['harga'],
                'kategori_id' => $request['kategori']
            ]);
            GambarProduk::create([
                'link_gambar' => $thumbnailUrl,
                'produk_id'     => $produk->id
            ]);
            return Redirect(Route('produk.admin'));
        }

        $kategori = $kategori->get();

        return view('admin.produk_create', compact('kategori'));
    }

    public function delete(Produk $produk)
    {   
        // dd($produk);
        $this->deleteImage($produk);
        $produk->gambar_produks()->delete();
        $produk->delete();
        return redirect(Route('produk.admin'));
    }

    public function show(Produk $produk)
    {
        return view('admin.produk_admin_show', compact('produk'));
    }

    public function show_produk(Produk $produk)
    {
        $promo = Promo::latest()->get();
        $produk_all = Produk::get();
        // dd($produk_all);
        $wa = Profil::get()->first()->no_wa;
        $url_wa = "https://api.whatsapp.com/send?phone=".$wa."&text=".url()->current()." .info produk ?";
        return view('show', compact('produk', 'promo', 'url_wa'));
    }

    public function edit(Request $request,Produk $produk, Kategori $kategori)
    {
        if($request->method() == "POST"){
            if (file_exists(request()->file('gambar'))){
                $this->deleteImage($produk);
                $thumbnail = request()->file('gambar');
                $thumbnailUrl = $thumbnail->store("public/images/produks");
                $thumbnailUrl = preg_replace("/public/i", "", $thumbnailUrl );
                $produk->gambar_produks()->first()->update(['link_gambar'=> $thumbnailUrl]);
            }

            // dd($produk);
            $produk->update($request->all());
            return redirect(Route('produk.admin'));
        }

        $kategori = $kategori->get();
        return view('admin.produk_admin_edit', compact('produk', 'kategori'));
    }
    
    public function deleteImage($produk)
    {
        $link = $produk->gambar_produks()->get();
        foreach ($link as $l){
            $urlImage = public_path().($l->first()->takeImage());
            if(file_exists($urlImage)){
                unlink($urlImage);
            }
        }
    }

}
