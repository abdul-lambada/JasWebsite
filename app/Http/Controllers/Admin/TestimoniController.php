<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proyek;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimoni = Testimoni::with('proyek')->latest()->paginate(10);
        return view('admin.testimoni.index', compact('testimoni'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proyek = Proyek::all();
        $proyek_id = request('proyek_id');
        
        return view('admin.testimoni.create', compact('proyek', 'proyek_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ProyekID' => 'required|exists:proyeks,ProyekID',
            'Nama' => 'required|string|max:255',
            'Jabatan' => 'required|string|max:255',
            'Isi' => 'required|string',
            'Rating' => 'required|integer|min:1|max:5',
        ]);

        $data = $request->all();
        $data['TanggalDiberikan'] = now();
        
        Testimoni::create($data);
        
        return redirect()->route('testimoni.index')
            ->with('success', 'Testimoni berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testimoni = Testimoni::with('proyek')->findOrFail($id);
        return view('admin.testimoni.show', compact('testimoni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $proyek = Proyek::all();
        
        return view('admin.testimoni.edit', compact('testimoni', 'proyek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ProyekID' => 'required|exists:proyeks,ProyekID',
            'Nama' => 'required|string|max:255',
            'Jabatan' => 'required|string|max:255',
            'Isi' => 'required|string',
            'Rating' => 'required|integer|min:1|max:5',
        ]);

        $testimoni = Testimoni::findOrFail($id);
        $testimoni->update($request->all());

        return redirect()->route('testimoni.index')
            ->with('success', 'Testimoni berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->delete();

        return redirect()->route('testimoni.index')
            ->with('success', 'Testimoni berhasil dihapus');
    }
}
