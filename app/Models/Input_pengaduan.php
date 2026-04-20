<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Route;

/**
 * @property int $id
 * @property int $user_id
 * @property int $kategori_id
 * @property string $judul_laporan
 * @property string $isi_laporan
 * @property string $tgl_pengaduan
 * @property string|null $foto
 * @property string $status
 * @property-read string|null $foto_url
 * @property-read string $status_label
 * @property-read string $status_badge_class
 * @property-read User $user
 * @property-read Kategories $kategori
 * @property-read Tanggapan|null $tanggapan
 */
class Input_pengaduan extends Model
{
    use HasFactory;

    protected $table = 'input_pengaduan';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul_laporan',
        'isi_laporan',
        'tgl_pengaduan',
        'foto',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategories::class, 'kategori_id', 'id');
    }

    public function tanggapan(): HasOne
    {
        return $this->hasOne(Tanggapan::class, 'pengaduan_id', 'id');
    }

    protected function fotoUrl(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return !empty($attributes['foto'])
                    ? (Route::has('reports.photo') ? route('reports.photo', $this) : asset('storage/' . $attributes['foto']))
                    : null;
            }
        );
    }

    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => match ($this->status) {
                '1' => 'Diproses',
                '2' => 'Selesai',
                default => 'Menunggu',
            }
        );
    }

    protected function statusBadgeClass(): Attribute
    {
        return Attribute::make(
            get: fn() => match ($this->status) {
                '1' => 'status-diproses',
                '2' => 'status-selesai',
                default => 'status-menunggu',
            }
        );
    }
}
