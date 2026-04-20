<?php

namespace Tests\Feature;

use App\Models\Input_pengaduan;
use App\Models\Kategories;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudentReportFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_siswa_can_create_a_report_with_photo(): void
    {
        Storage::fake('public');
        $this->seed();

        $siswa = User::where('level', 'siswa')->firstOrFail();
        $kategori = Kategories::firstOrFail();

        $response = $this->actingAs($siswa)->post(route('aspirasi.store'), [
            'kategori_id' => $kategori->id,
            'judul_laporan' => 'Lampu kelas mati total',
            'isi_laporan' => 'Lampu di ruang praktik mati sejak pagi dan perlu diganti.',
            'foto' => UploadedFile::fake()->image('lampu-rusak.jpg'),
        ]);

        $response->assertRedirect(route('history'));
        $response->assertSessionHas('success');

        $report = Input_pengaduan::where('judul_laporan', 'Lampu kelas mati total')->first();

        $this->assertNotNull($report);
        $this->assertSame($siswa->id, $report->user_id);
        $this->assertSame('0', $report->status);
        Storage::disk('public')->assertExists($report->foto);
    }

    public function test_siswa_can_view_history_page(): void
    {
        $this->seed();

        $siswa = User::where('level', 'siswa')->firstOrFail();

        $response = $this->actingAs($siswa)->get(route('history'));

        $response->assertOk();
        $response->assertSee('Kursi rusak di kelas XII RPL 1');
    }
}
