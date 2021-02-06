<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{GambarProduk};

class GambarController extends Controller
{
    public function create(Request $request)
    {
        if($request->method() == "POST"){
            $thumbnailUrl = $this->imageurl($request);
            // dd($request['produk_id']);
            if ($thumbnailUrl != ""){
                GambarProduk::create([
                    'link_gambar' => $thumbnailUrl,
                    'produk_id'   => $request['produk_id']
                ]);
            }
            return redirect(url()->previous());
        }
    }

    public function delete(Request $request)
    {
        $id = $request['id'];
        $gambar = GambarProduk::find($id);
        $this->deleteImage($gambar);
        $gambar->delete();
        return redirect(url()->previous());
    }

    public function imageurl($request)
    {
        if (file_exists($request->file('gambar'))){
            $thumbnail = $request->file('gambar');
            $thumbnailUrl = $thumbnail->store("public/images/produks");
            $thumbnailUrl = preg_replace("/public/i", "", $thumbnailUrl );
        } else {
            $thumbnailUrl = "";
        }
        return $thumbnailUrl;
    }

    public function deleteImage($gambar)
    {
        $urlImage = public_path().($gambar->takeImage());
        if(file_exists($urlImage)){
            unlink($urlImage);
        }
        
    }
}
