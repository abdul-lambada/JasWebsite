<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Klien;

class KlienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $klien = Klien::latest()->paginate(10);
        return view('admin.klien.index', compact('klien'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.klien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:klien,Email',
            'NoTelepon' => 'required|string|max:20',
            'JenisKlien' => 'required|string|max:50',
            'TanggalRegistrasi' => 'required|date',
        ]);

        Klien::create($request->all());
        return redirect()->route('klien.index')->with('success', 'Klien berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $klien = Klien::findOrFail($id);
        return view('admin.klien.show', compact('klien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $klien = Klien::findOrFail($id);
        return view('admin.klien.edit', compact('klien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:klien,Email,'.$id.',KlienID',
            'NoTelepon' => 'required|string|max:20',
            'JenisKlien' => 'required|string|max:50',
            'TanggalRegistrasi' => 'required|date',
        ]);

        $klien = Klien::findOrFail($id);
        $klien->update($request->all());
        
        return redirect()->route('klien.index')->with('success', 'Data klien berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $klien = Klien::findOrFail($id);
        $klien->delete();
        
        return redirect()->route('klien.index')->with('success', 'Data klien berhasil dihapus');
    }
}
