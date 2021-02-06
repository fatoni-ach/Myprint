<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
        'nama','alamat','no_wa','link_gambar', 'user_id'
    ];
    
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function takeImage()
    {
        return "/storage" . $this->link_gambar;
    }
}
