<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategories extends Model
{
    protected $table = 'kategories';

    protected $fillable = [
        'nama_kategori'
    ];

    public function inputPengaduan()
    {
        return $this->hasMany(Input_pengaduan::class, 'kategori_id');
    }
}
