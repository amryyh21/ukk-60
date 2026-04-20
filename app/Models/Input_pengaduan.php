<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategories::class, 'kategori_id', 'id');
    }

    public function tanggapan()
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
