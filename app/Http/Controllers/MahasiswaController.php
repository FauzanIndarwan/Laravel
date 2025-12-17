<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::latest()->paginate(10);
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas,nim|max:255',
            'email' => 'required|email|unique:mahasiswas,email|max:255',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('mahasiswa/fotos', 'public');
            $validated['foto'] = $fotoPath;
        }

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:mahasiswas,nim,' . $mahasiswa->id,
            'email' => 'required|email|max:255|unique:mahasiswas,email,' . $mahasiswa->id,
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($mahasiswa->foto) {
                Storage::disk('public')->delete($mahasiswa->foto);
            }
            $fotoPath = $request->file('foto')->store('mahasiswa/fotos', 'public');
            $validated['foto'] = $fotoPath;
        }

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        // Delete photo if exists
        if ($mahasiswa->foto) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }

        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
