<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategories;
use App\Models\Input_pengaduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['nis_nip' => '00000000'],
            [
                'name' => 'Admin Test',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin21'),
                'level' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['nis_nip' => '20240015'],
            [
                'name' => 'Ahmad Student',
                'email' => 'ahmad@sekolah.sch.id',
                'kelas' => 'XII RPL 1',
                'telp' => '081234567890',
                'password' => Hash::make('siswa21'),
                'level' => 'siswa',
            ]
        );

        foreach (['AC', 'Plumbing', 'Meja', 'Kursi', 'Lapangan'] as $kategori) {
            Kategories::updateOrCreate(
                ['nama_kategori' => $kategori],
                ['nama_kategori' => $kategori]
            );
        }

        $siswa = User::where('nis_nip', '20240015')->first();
        $kategori = Kategories::where('nama_kategori', 'Kursi')->first();

        if ($siswa && $kategori) {
            Input_pengaduan::updateOrCreate(
                ['user_id' => $siswa->id, 'judul_laporan' => 'Kursi rusak di kelas XII RPL 1'],
                [
                    'kategori_id' => $kategori->id,
                    'isi_laporan' => 'Kursi bagian kaki belakang longgar dan tidak aman dipakai.',
                    'tgl_pengaduan' => now()->toDateString(),
                    'status' => '0',
                ]
            );
        }
    }
}
