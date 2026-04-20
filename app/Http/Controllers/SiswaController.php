<?php

namespace App\Http\Controllers;

use App\Models\Input_pengaduan;
use App\Models\Kategories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SiswaController extends Controller
{
    protected function siswa(): User
    {
        /** @var User|null $user */
        $user = Auth::user();

        abort_unless($user && $user->level === 'siswa', 403);

        return $user;
    }

    public function dashboard()
    {
        $user = $this->siswa();
        $pengaduan = Input_pengaduan::with('kategori')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('siswa.dashboard', [
            'user' => $user,
            'pendingCount' => $pengaduan->where('status', '0')->count(),
            'processCount' => $pengaduan->where('status', '1')->count(),
            'completedCount' => $pengaduan->where('status', '2')->count(),
            'recentReports' => $pengaduan->take(5),
            'totalReports' => $pengaduan->count(),
        ]);
    }

    public function createAspirasi()
    {
        $user = $this->siswa();

        return view('siswa.input_aspirasi', [
            'user' => $user,
            'categories' => Kategories::orderBy('nama_kategori')->get(),
        ]);
    }

    public function storeAspirasi(Request $request)
    {
        $user = $this->siswa();

        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategories,id',
            'judul_laporan' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:20480',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('laporan', 'public');
        }

        $validated['user_id'] = $user->id;
        $validated['tgl_pengaduan'] = now()->toDateString();
        $validated['status'] = '0';

        Input_pengaduan::create($validated);

        return redirect()
            ->route('history')
            ->with('success', 'Laporan berhasil dikirim.');
    }

    public function history()
    {
        $user = $this->siswa();

        return view('siswa.history', [
            'user' => $user,
            'reports' => Input_pengaduan::with('kategori')
                ->where('user_id', $user->id)
                ->latest()
                ->get(),
        ]);
    }

    public function photo(Input_pengaduan $report): StreamedResponse
    {
        /** @var User|null $user */
        $user = Auth::user();

        abort_unless($user && ($user->level === 'admin' || $report->user_id === $user->id), 403);
        abort_unless($report->foto && Storage::disk('public')->exists($report->foto), 404);

        return Storage::disk('public')->response($report->foto);
    }

    public function profile()
    {
        $user = $this->siswa();
        $pengaduan = Input_pengaduan::where('user_id', $user->id)->get();

        return view('siswa.profil', [
            'user' => $user,
            'totalReports' => $pengaduan->count(),
            'completedCount' => $pengaduan->where('status', '2')->count(),
            'processCount' => $pengaduan->where('status', '1')->count(),
        ]);
    }
}
