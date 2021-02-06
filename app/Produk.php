<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'nama','deskripsi','harga', 'kategori_id', 'slug', 'id'
    ];
    
    public function gambar_produks()
    {
        return $this->hasMany(GambarProduk::class);
    }

    public function kategori()
    {
        return $this->hasOne(Kategori::class);
    }
    public function promo()
    {
        return $this->hasOne(Promo::class);
    }
    public function unggulan_produk()
    {
        return $this->hasOne(UnggulanProduk::class);
    }
}
