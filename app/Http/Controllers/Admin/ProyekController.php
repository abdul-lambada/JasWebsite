<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Proyek;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyek = Proyek::with(['pesanan', 'tims'])->latest()->paginate(10);
        return view('admin.proyek.index', compact('proyek'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pesanan = Pesanan::whereDoesntHave('proyek')
            ->where('Status', '!=', 'Dibatalkan')
            ->get();
        $tim = Tim::all();
        $pesanan_id = request('pesanan_id');
        
        return view('admin.proyek.create', compact('pesanan', 'tim', 'pesanan_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'PesananID' => 'required|exists:pesanans,PesananID',
            'NamaProyek' => 'required|string|max:255',
            'URLGambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'URLWebsite' => 'nullable|url|max:255',
            'tim' => 'required|array|min:1',
            'tim.*' => 'exists:tims,TimID',
        ]);

        $data = $request->except(['URLGambar', 'tim']);
        
        if ($request->hasFile('URLGambar')) {
            $file = $request->file('URLGambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/proyek', $fileName);
            $data['URLGambar'] = 'proyek/' . $fileName;
        }

        $proyek = Proyek::create($data);
        
        // Sync tim yang mengerjakan proyek
        $proyek->tims()->sync($request->tim);
        
        // Update status pesanan menjadi Diproses
        $pesanan = Pesanan::find($request->PesananID);
        if ($pesanan && $pesanan->Status == 'Pending') {
            $pesanan->update(['Status' => 'Diproses']);
        }

        return redirect()->route('proyek.index')
            ->with('success', 'Proyek berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proyek = Proyek::with(['pesanan', 'tims', 'testimonis'])->findOrFail($id);
        return view('admin.proyek.show', compact('proyek'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proyek = Proyek::with('tims')->findOrFail($id);
        $pesanan = Pesanan::where('Status', '!=', 'Dibatalkan')
            ->where(function($query) use ($proyek) {
                $query->whereDoesntHave('proyek')
                    ->orWhere('PesananID', $proyek->PesananID);
            })
            ->get();
        $tim = Tim::all();
        $selectedTim = $proyek->tims->pluck('TimID')->toArray();
        
        return view('admin.proyek.edit', compact('proyek', 'pesanan', 'tim', 'selectedTim'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'PesananID' => 'required|exists:pesanans,PesananID',
            'NamaProyek' => 'required|string|max:255',
            'URLGambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'URLWebsite' => 'nullable|url|max:255',
            'tim' => 'required|array|min:1',
            'tim.*' => 'exists:tims,TimID',
        ]);

        $proyek = Proyek::findOrFail($id);
        $data = $request->except(['URLGambar', 'tim']);
        
        if ($request->hasFile('URLGambar')) {
            // Hapus gambar lama jika ada
            if ($proyek->URLGambar && Storage::exists('public/' . $proyek->URLGambar)) {
                Storage::delete('public/' . $proyek->URLGambar);
            }
            
            $file = $request->file('URLGambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/proyek', $fileName);
            $data['URLGambar'] = 'proyek/' . $fileName;
        }

        $proyek->update($data);
        
        // Sync tim yang mengerjakan proyek
        $proyek->tims()->sync($request->tim);

        return redirect()->route('proyek.index')
            ->with('success', 'Proyek berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proyek = Proyek::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($proyek->URLGambar && Storage::exists('public/' . $proyek->URLGambar)) {
            Storage::delete('public/' . $proyek->URLGambar);
        }
        
        // Hapus relasi dengan tim
        $proyek->tims()->detach();
        
        $proyek->delete();

        return redirect()->route('proyek.index')
            ->with('success', 'Proyek berhasil dihapus');
    }
}
