<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paket = Paket::latest()->paginate(10);
        return view('admin.paket.index', compact('paket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.paket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NamaPaket' => 'required|string|max:255',
            'Deskripsi' => 'required|string',
            'HargaDasar' => 'required|numeric',
            'EstimasiWaktu' => 'required|string|max:50',
            'IsPopuler' => 'boolean',
        ]);

        $data = $request->all();
        $data['IsPopuler'] = $request->has('IsPopuler') ? 1 : 0;

        Paket::create($data);
        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paket = Paket::findOrFail($id);
        return view('admin.paket.show', compact('paket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paket = Paket::findOrFail($id);
        return view('admin.paket.edit', compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'NamaPaket' => 'required|string|max:255',
            'Deskripsi' => 'required|string',
            'HargaDasar' => 'required|numeric',
            'EstimasiWaktu' => 'required|string|max:50',
            'IsPopuler' => 'boolean',
        ]);

        $paket = Paket::findOrFail($id);
        $data = $request->all();
        $data['IsPopuler'] = $request->has('IsPopuler') ? 1 : 0;
        
        $paket->update($data);
        return redirect()->route('paket.index')->with('success', 'Data paket berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();
        
        return redirect()->route('paket.index')->with('success', 'Data paket berhasil dihapus');
    }
}
