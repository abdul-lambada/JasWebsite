<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Klien;
use App\Models\Paket;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan = Pesanan::with(['klien', 'paket'])->latest()->paginate(10);
        return view('admin.pesanan.index', compact('pesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $klien = Klien::all();
        $paket = Paket::all();
        return view('admin.pesanan.create', compact('klien', 'paket'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'KlienID' => 'required|exists:kliens,KlienID',
            'PaketID' => 'required|exists:pakets,PaketID',
            'TanggalPesanan' => 'required|date',
            'Status' => 'required|in:Pending,Diproses,Selesai,Dibatalkan',
        ]);

        Pesanan::create($request->all());

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pesanan = Pesanan::with(['klien', 'paket', 'proyek'])->findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $klien = Klien::all();
        $paket = Paket::all();
        return view('admin.pesanan.edit', compact('pesanan', 'klien', 'paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'KlienID' => 'required|exists:kliens,KlienID',
            'PaketID' => 'required|exists:pakets,PaketID',
            'TanggalPesanan' => 'required|date',
            'Status' => 'required|in:Pending,Diproses,Selesai,Dibatalkan',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($request->all());

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        // Cek apakah pesanan memiliki proyek terkait
        if ($pesanan->proyek) {
            return redirect()->route('pesanan.index')
                ->with('error', 'Pesanan tidak dapat dihapus karena memiliki proyek terkait');
        }
        
        $pesanan->delete();

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil dihapus');
    }
}
