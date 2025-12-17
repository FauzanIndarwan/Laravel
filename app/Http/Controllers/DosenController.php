<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosens = Dosen::latest()->paginate(10);
        return view('dosen.index', compact('dosens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:dosens,nip|max:255',
            'email' => 'required|email|unique:dosens,email|max:255',
            'bidang_keahlian' => 'required|string|max:255',
        ]);

        Dosen::create($validated);

        return redirect()->route('dosen.index')
            ->with('success', 'Dosen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        $dosen->load('proyeks');
        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:dosens,nip,' . $dosen->id,
            'email' => 'required|email|max:255|unique:dosens,email,' . $dosen->id,
            'bidang_keahlian' => 'required|string|max:255',
        ]);

        $dosen->update($validated);

        return redirect()->route('dosen.index')
            ->with('success', 'Dosen berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return redirect()->route('dosen.index')
            ->with('success', 'Dosen berhasil dihapus.');
    }
}
