<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\{Profil};
use Auth;
use App\Classes\OptimizeImage;

class ProfilController extends Controller
{
    public function profil(Request $request, Profil $profil)
    {   
        if($request->method() == "POST"){
            $this->validation($request);
            $thumbnailUrl = $this->imageurl($request);
            $profil = Profil::create([
                'nama' => $request['nama'],
                'alamat'=> $request['alamat'],
                'no_wa' => $request['no_wa'],
                'facebook' => $request['facebook'],
                'instagram' => $request['instagram'],
                'link_gambar' => $thumbnailUrl,
                'user_id'   => Auth::user()->id

            ]);
            return redirect(Route('profil'));
        }
        $profil = Profil::where('user_id', Auth::user()->id)->get()->first();
        return view('admin.profil', compact('profil'));
    }

    public function update(Request $request)
    {
        if($request->method() == "POST"){
            $profil = Profil::where('user_id', Auth::user()->id)->get()->first();
            if (file_exists($request->file('gambar'))){
                $this->deleteImage($profil);
                $thumbnailUrl = $this->imageurl($request);
                $profil->update([
                    'link_gambar' => $thumbnailUrl
                ]);
            }
            $profil->update($request->all());
            return redirect(Route('profil'));
        }
    }

    public function imageurl($request)
    {
        if (file_exists($request->file('gambar'))){
            $thumbnail = $request->file('gambar');
            // $thumbnailUrl = $thumbnail->store("public/images/profil");
            // $thumbnailUrl = preg_replace("/public/i", "", $thumbnailUrl );
            $name = md5(microtime()).'_'.$thumbnail->getClientOriginalName();
            $path = base_path()."/public/storage/images/profil";
            $thumbnailUrl = $thumbnail->move($path, $name);
            $optimizer = new OptimizeImage();
            $optimizer->run_optimizer($thumbnailUrl);
            $thumbnailUrl = "/images/profil/".$name;
        } else {
            $thumbnailUrl = "";
        }
        return $thumbnailUrl;
    }

    public function deleteImage($profil)
    {
        $urlImage = base_path()."/public".($profil->takeImage());
        if(file_exists($urlImage)){
            unlink($urlImage);
        }   
    }

    public function validation($request)
    {
        $request->validate([
            'nama' => 'nullable',
            'alamat'=> 'nullable',
            'no_wa' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'link_gambar' => 'nullable',
            'user_id'   => 'nullable'
        ]);
    }
}
