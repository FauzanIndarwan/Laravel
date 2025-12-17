<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyeks = Proyek::with(['mahasiswa', 'dosen'])->latest()->paginate(10);
        return view('proyek.index', compact('proyeks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        return view('proyek.create', compact('mahasiswas', 'dosens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'dosen_id' => 'required|exists:dosens,id',
            'dokumen' => 'required|file|mimes:pdf,docx|max:2048',
            'status' => 'required|string|in:active,completed,cancelled',
        ]);

        if ($request->hasFile('dokumen')) {
            $dokumenPath = $request->file('dokumen')->store('proyek/dokumen', 'public');
            $validated['dokumen'] = $dokumenPath;
        }

        Proyek::create($validated);

        return redirect()->route('proyek.index')
            ->with('success', 'Proyek berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyek $proyek)
    {
        $proyek->load(['mahasiswa', 'dosen']);
        return view('proyek.show', compact('proyek'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyek $proyek)
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        return view('proyek.edit', compact('proyek', 'mahasiswas', 'dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyek $proyek)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'dosen_id' => 'required|exists:dosens,id',
            'dokumen' => 'nullable|file|mimes:pdf,docx|max:2048',
            'status' => 'required|string|in:active,completed,cancelled',
        ]);

        if ($request->hasFile('dokumen')) {
            // Delete old document
            if ($proyek->dokumen) {
                Storage::disk('public')->delete($proyek->dokumen);
            }
            $dokumenPath = $request->file('dokumen')->store('proyek/dokumen', 'public');
            $validated['dokumen'] = $dokumenPath;
        }

        $proyek->update($validated);

        return redirect()->route('proyek.index')
            ->with('success', 'Proyek berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyek $proyek)
    {
        // Delete document if exists
        if ($proyek->dokumen) {
            Storage::disk('public')->delete($proyek->dokumen);
        }

        $proyek->delete();

        return redirect()->route('proyek.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }
}
