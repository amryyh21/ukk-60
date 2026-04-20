<?php

namespace App\Http\Controllers;

use App\Models\Kategories;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class KategoriesController extends Controller
{
    protected function adminUser(): User
    {
        $user = Auth::user();

        if (! $user instanceof User || $user->level !== 'admin') {
            abort(403);
        }

        return $user;
    }

    public function index(): View
    {
        return view('admin.input_kategori', [
            'user' => $this->adminUser(),
            'categories' => Kategories::latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->adminUser();

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategories,nama_kategori',
        ]);

        Kategories::create($validated);

        return redirect()->route('addKategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy(Kategories $kategories): RedirectResponse
    {
        $this->adminUser();

        if ($kategories->inputPengaduan()->exists()) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena sudah dipakai pada laporan.');
        }

        $kategories->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
