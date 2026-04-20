<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $pengaduan_id
 * @property int $user_id
 * @property string $tgl_tanggapan
 * @property string $tanggapan
 */
class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan';

    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'tgl_tanggapan',
        'tanggapan',
    ];

    public function input_pengaduan(): BelongsTo
    {
        return $this->belongsTo(Input_pengaduan::class, 'pengaduan_id', 'id');
    }
}
