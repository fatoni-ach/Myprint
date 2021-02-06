<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Kategori};

class KategoriController extends Controller
{
    public function kategori(Kategori $kategori)
    {
        $kategori = $kategori->get()->sortBy('id');
        return view('admin.kategori', compact('kategori'));
    }

    public function create(Request $request)
    {
        if ($request->method() == "POST"){
            Kategori::create($request->all());
            return redirect(url()->previous());
        }
    }

    public function delete(Request $request)
    {   
        if ($request->method() == "PUT"){
            // dd($request);
            $kategori = Kategori::find($request['id']);
            // dd($kategori);
            $kategori->delete();
            return redirect(Route('kategori'));
        }
    }

    public function update(Request $request)
    {
        if($request->method() == "POST"){
            $kategori = Kategori::find($request['id']);
            $kategori->update($request->all());
            return redirect(Route('kategori'));
        }
    }
}
