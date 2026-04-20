<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $nama_kategori
 */
class Kategories extends Model
{
    protected $table = 'kategories';

    protected $fillable = [
        'nama_kategori'
    ];

    public function inputPengaduan(): HasMany
    {
        return $this->hasMany(Input_pengaduan::class, 'kategori_id');
    }
}
