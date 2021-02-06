<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnggulanProduk extends Model
{
    protected $fillable = [
    ];
    
    public function produk()
    {
        return $this->hasOne(Produk::class);
    }
    
}
