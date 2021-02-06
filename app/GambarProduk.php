<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
    protected $fillable = [
        'link_gambar', 'produk_id'
    ];
    
    public function produk()
    {
        return $this->hasOne(Produk::class);
    }

    public function takeImage()
    {
        return "/storage" . $this->link_gambar;
    }
    
    
}
