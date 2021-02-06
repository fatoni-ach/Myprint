<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\{Profil};
use Auth;

class ProfilController extends Controller
{
    public function profil(Request $request, Profil $profil)
    {   
        if($request->method() == "POST"){
            $thumbnailUrl = $this->imageurl($request);
            $profil = Profil::create([
                'nama' => $request['nama'],
                'alamat'=> $request['alamat'],
                'no_wa' => $request['no_wa'],
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
            if (file_exists($request->file('gambar'))){
                $profil = Profil::where('user_id', Auth::user()->id)->get()->first();
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
            $thumbnailUrl = $thumbnail->store("public/images/profil");
            $thumbnailUrl = preg_replace("/public/i", "", $thumbnailUrl );
        } else {
            $thumbnailUrl = "";
        }
        return $thumbnailUrl;
    }

    public function deleteImage($profil)
    {
        $urlImage = public_path().($profil->takeImage());
        if(file_exists($urlImage)){
            unlink($urlImage);
        }
        
    }
}
