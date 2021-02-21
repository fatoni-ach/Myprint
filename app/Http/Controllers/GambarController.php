<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{GambarProduk};
use App\Classes\OptimizeImage;

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
        return $thumbnailUrl;
    }

    public function deleteImage($gambar)
    {
        if($gambar->link_gambar != null){
            $urlImage = base_path()."/public".($gambar->takeImage());
            // dd($urlImage);
            if(file_exists($urlImage)){
                unlink($urlImage);
            }
        }
        
    }
}
