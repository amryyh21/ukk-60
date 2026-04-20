<?php

namespace Tests\Feature;

use App\Models\Input_pengaduan;
use App\Models\Kategories;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_report_status(): void
    {
        $this->seed();

        $admin = User::where('level', 'admin')->firstOrFail();
        $report = Input_pengaduan::firstOrFail();

        $response = $this->actingAs($admin)->patch(route('manageAspirasi.status', $report), [
            'status' => '2',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('input_pengaduan', [
            'id' => $report->id,
            'status' => '2',
        ]);
    }

    public function test_admin_can_create_and_delete_unused_category(): void
    {
        $this->seed();

        $admin = User::where('level', 'admin')->firstOrFail();

        $createResponse = $this->actingAs($admin)->post(route('addKategori.store'), [
            'nama_kategori' => 'Proyektor',
        ]);

        $createResponse->assertRedirect(route('addKategori'));
        $this->assertDatabaseHas('kategories', ['nama_kategori' => 'Proyektor']);

        $category = Kategories::where('nama_kategori', 'Proyektor')->firstOrFail();

        $deleteResponse = $this->actingAs($admin)->delete(route('addKategori.destroy', $category));

        $deleteResponse->assertRedirect();
        $deleteResponse->assertSessionHas('success');
        $this->assertDatabaseMissing('kategories', ['id' => $category->id]);
    }

    public function test_siswa_cannot_open_admin_dashboard(): void
    {
        $this->seed();

        $siswa = User::where('level', 'siswa')->firstOrFail();

        $response = $this->actingAs($siswa)->get(route('dashboard.admin'));

        $response->assertForbidden();
    }
}
