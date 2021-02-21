<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Produk, Promo};
use App\Classes\OptimizeImage;

class PromoController extends Controller
{
    public function promo()
    {
        $promo = Promo::latest()->get();
        $produk = Produk::get();
        return view('admin.promo', compact('promo', 'produk'));
    }

    public function create(Produk $produk, Request $request)
    {
        if ($request->method() == "POST"){
            // dd($request->file());
            $temp = Promo::where('produk_id', $request['produk_id'])->get();
            if($temp->count() <= 0){
                $thumbnailUrl = $this->imageurl($request);
                Promo::create([
                    'link_gambar' => $thumbnailUrl,
                    'produk_id'     => $request['produk_id']
                ]);
            }
            return redirect(url()->previous());
        }
    }
    public function delete(Request $request)
    {
        if($request->method() == "POST"){
            $promo = Promo::find($request['id']);
            $this->deleteImage($promo);
            $promo->delete();
            return redirect(url()->previous());
        }
    }

    public function update(Request $request)
    {
        if($request->method() == "POST"){
            $promo = Promo::find($request['id']);
            if (file_exists($request->file('gambar'))){
                $this->deleteImage($promo);
                $thumbnailUrl = $this->imageurl($request);
                $promo->update([
                    'link_gambar'   => $thumbnailUrl
                ]);
            }
            return redirect(url()->previous());
        }
    }

    public function imageurl($request)
    {
        if (file_exists($request->file('gambar'))){
            $thumbnail = $request->file('gambar');
            $path = base_path()."/public/storage/images/promo";
            $name = md5(microtime()).'_'.$thumbnail->getClientOriginalName();
            $thumbnailUrl = $thumbnail->move($path, $name);
            $optimizer = new OptimizeImage();
            $optimizer->run_optimizer($thumbnailUrl);
            $thumbnailUrl = "/images/promo/".$name;
        } else {
            $thumbnailUrl = "";
        }
        return $thumbnailUrl;
    }

    public function deleteImage($promo)
    {
        $urlImage = base_path()."/public".($promo->takeImage());
        // dd($urlImage);
        if(file_exists($urlImage)){
            unlink($urlImage);
        }
        
    }
}
