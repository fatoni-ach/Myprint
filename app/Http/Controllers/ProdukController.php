<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Produk, Kategori, GambarProduk, Profil, Promo};
use App\Classes\OptimizeImage;

class ProdukController extends Controller
{
    
    public function index(Request $request)
    {   
        $promo = Promo::latest()->get();
        $profil = Profil::get()->first();
        $produk_all = Produk::get();
        $kategori = Kategori::get()->sortBy('id');
        // $url_wa = "https://api.whatsapp.com/send?phone=".$profil->no_wa;
        if(isset($request['sort'])){
            $produk = new Produk;
            $produk = $this->sort($request['sort'], "kategori", $produk);
        } else{
            $produk = Produk::latest()->paginate(6);
        }
        return view('produk', compact('produk', 'profil', 'kategori', 'promo', 'produk_all'));
    }

    public function produk_admin(Produk $produk, GambarProduk $gambarProduk)
    {
        $kategori = Kategori::get()->sortBy('id');
        $produk = Produk::latest()->paginate(6);
        return view('admin.produk_admin', compact('produk', 'kategori'));
    }

    public function kategori(Kategori $kategori, Request $request)
    {   
        if(isset($request['sort'])){
            // $produk = $this->sort($request['sort'], "kategori");
            $produk = Produk::where('kategori_id', $kategori->id);
            $produk = $this->sort($request['sort'], "kategori", $produk);
        } else{
            $produk = Produk::where('kategori_id', $kategori->id)->paginate(6);
        }
        $profil = Profil::get()->first();
        $promo = Promo::latest()->get();
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
                $path = base_path()."/public/storage/images/produks";
                // dd($path);
                $name = md5(microtime()).'_'.$thumbnail->getClientOriginalName();
                $thumbnailUrl = $thumbnail->move($path, $name);
                $optimizer = new OptimizeImage();
                $optimizer->run_optimizer($thumbnailUrl);
                $thumbnailUrl = "/images/produks/".$name;
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
        $profil = Profil::get()->first();
        if(isset($profil)){
            $url_wa = "https://api.whatsapp.com/send?phone=".$profil->url_wa."&text=".url()->current()." .info produk ?";
        } else {
            $url_wa = "";
        }
        return view('show', compact('produk', 'promo', 'url_wa', 'profil'));
    }

    public function edit(Request $request,Produk $produk, Kategori $kategori)
    {
        if($request->method() == "POST"){
            if (file_exists(request()->file('gambar'))){
                $this->deleteImage($produk);
                $thumbnail = request()->file('gambar');
                $name = md5(microtime()).'_'.$thumbnail->getClientOriginalName();
                
                $path = base_path()."/public/storage/images/produks";
                $thumbnailUrl = $thumbnail->move($path, $name);
                $optimizer = new OptimizeImage();
                $optimizer->run_optimizer($thumbnailUrl);
                $thumbnailUrl = "/images/produks/".$name;
                
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
            $urlImage = base_path()."/public".($l->takeImage());
            if(file_exists($urlImage)){
                unlink($urlImage);
            }
        }
    }

    public function sort($by, $tipe, $produk)
    {
        // if($tipe == "normal"){
        //     switch ($by) {
        //         case "terbaru":
        //             $produk = Produk::orderBy('created_at', 'desc')->paginate(6);
        //             break;
        //         case "terlama":
        //             $produk = Produk::orderBy('created_at', 'asc')->paginate(6);
        //             break;
        //         case "termahal":
        //             $produk = Produk::orderBy('harga', 'desc')->paginate(6);
        //             break;
        //         case "termurah":
        //             $produk = Produk::orderBy('harga', 'asc')->paginate(6);
        //             break;
        //         default:
        //         " ";
        //     }
        // }
        if($tipe == "kategori"){
            switch ($by) {
                case "terbaru":
                    $produk = $produk->orderBy('created_at', 'desc')->paginate(6);
                    break;
                case "terlama":
                    $produk = $produk->orderBy('created_at', 'asc')->paginate(6);
                    break;
                case "termahal":
                    $produk = $produk->orderBy('harga', 'desc')->paginate(6);
                    break;
                case "termurah":
                    $produk = $produk->orderBy('harga', 'asc')->paginate(6);
                    break;
                default:
                " ";
            }
        }
        return $produk;
    }

}
