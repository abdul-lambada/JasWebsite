<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tim = Tim::latest()->paginate(10);
        return view('admin.tim.index', compact('tim'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tim.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nama' => 'required|string|max:255',
            'Jabatan' => 'required|string|max:255',
            'URLFoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'LinkLinkedin' => 'nullable|url|max:255',
            'Keahlian' => 'required|string|max:255',
        ]);

        $data = $request->except('URLFoto');
        
        if ($request->hasFile('URLFoto')) {
            $file = $request->file('URLFoto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/tim', $fileName);
            $data['URLFoto'] = 'tim/' . $fileName;
        }

        Tim::create($data);

        return redirect()->route('tim.index')
            ->with('success', 'Data anggota tim berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tim = Tim::findOrFail($id);
        return view('admin.tim.show', compact('tim'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tim = Tim::findOrFail($id);
        return view('admin.tim.edit', compact('tim'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nama' => 'required|string|max:255',
            'Jabatan' => 'required|string|max:255',
            'URLFoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'LinkLinkedin' => 'nullable|url|max:255',
            'Keahlian' => 'required|string|max:255',
        ]);

        $tim = Tim::findOrFail($id);
        $data = $request->except('URLFoto');
        
        if ($request->hasFile('URLFoto')) {
            // Hapus foto lama jika ada
            if ($tim->URLFoto && Storage::exists('public/' . $tim->URLFoto)) {
                Storage::delete('public/' . $tim->URLFoto);
            }
            
            $file = $request->file('URLFoto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/tim', $fileName);
            $data['URLFoto'] = 'tim/' . $fileName;
        }

        $tim->update($data);

        return redirect()->route('tim.index')
            ->with('success', 'Data anggota tim berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tim = Tim::findOrFail($id);
        
        // Hapus foto jika ada
        if ($tim->URLFoto && Storage::exists('public/' . $tim->URLFoto)) {
            Storage::delete('public/' . $tim->URLFoto);
        }
        
        $tim->delete();

        return redirect()->route('tim.index')
            ->with('success', 'Data anggota tim berhasil dihapus');
    }
}
