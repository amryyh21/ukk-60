<?php

namespace App\Http\Controllers;

use App\Models\Input_pengaduan;
use App\Models\Kategories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected function admin()
    {
        $user = Auth::user();

        abort_unless($user && $user->level === 'admin', 403);

        return $user;
    }

    public function dashboard()
    {
        $user = $this->admin();
        $reports = Input_pengaduan::with(['user', 'kategori'])->latest()->get();
        $completedCount = $reports->where('status', '2')->count();
        $totalReports = $reports->count();

        return view('admin.dashboard', [
            'user' => $user,
            'totalReports' => $totalReports,
            'verifyCount' => $reports->where('status', '0')->count(),
            'inProgressCount' => $reports->where('status', '1')->count(),
            'completionRate' => $totalReports > 0 ? round(($completedCount / $totalReports) * 100, 1) : 0,
            'recentReports' => $reports->take(5),
            'categories' => Kategories::orderBy('nama_kategori')->get(),
        ]);
    }

    public function reports()
    {
        $user = $this->admin();

        return view('admin.manageAspirasi', [
            'user' => $user,
            'reports' => Input_pengaduan::with(['user', 'kategori'])->latest()->get(),
        ]);
    }

    public function updateReportStatus(Request $request, Input_pengaduan $report)
    {
        $this->admin();

        $validated = $request->validate([
            'status' => 'required|in:0,1,2',
        ]);

        $report->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function students()
    {
        $user = $this->admin();
        $students = User::where('level', 'siswa')
            ->withCount('pengaduan')
            ->orderBy('name')
            ->get();

        return view('admin.manajemenSiswa', [
            'user' => $user,
            'students' => $students,
        ]);
    }
}
