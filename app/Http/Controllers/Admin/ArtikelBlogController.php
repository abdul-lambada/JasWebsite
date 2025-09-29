<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArtikelBlog;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtikelBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = ArtikelBlog::with('penulis')
            ->orderBy('TanggalPublikasi', 'desc')
            ->paginate(10);
        
        return view('admin.artikel-blog.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penulis = Tim::orderBy('Nama')->get();
        return view('admin.artikel-blog.create', compact('penulis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'PenulisID' => 'required|exists:tims,TimID',
            'Judul' => 'required|string|max:200',
            'Konten' => 'required|string',
            'TanggalPublikasi' => 'required|date',
        ]);

        ArtikelBlog::create([
            'PenulisID' => $request->PenulisID,
            'Judul' => $request->Judul,
            'Konten' => $request->Konten,
            'TanggalPublikasi' => $request->TanggalPublikasi,
        ]);

        return redirect()->route('artikel-blog.index')
            ->with('success', 'Artikel berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artikel = ArtikelBlog::with('penulis')->findOrFail($id);
        return view('admin.artikel-blog.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artikel = ArtikelBlog::findOrFail($id);
        $penulis = Tim::orderBy('Nama')->get();
        
        return view('admin.artikel-blog.edit', compact('artikel', 'penulis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'PenulisID' => 'required|exists:tims,TimID',
            'Judul' => 'required|string|max:200',
            'Konten' => 'required|string',
            'TanggalPublikasi' => 'required|date',
        ]);

        $artikel = ArtikelBlog::findOrFail($id);
        $artikel->update([
            'PenulisID' => $request->PenulisID,
            'Judul' => $request->Judul,
            'Konten' => $request->Konten,
            'TanggalPublikasi' => $request->TanggalPublikasi,
        ]);

        return redirect()->route('artikel-blog.index')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $artikel = ArtikelBlog::findOrFail($id);
        $artikel->delete();

        return redirect()->route('artikel-blog.index')
            ->with('success', 'Artikel berhasil dihapus');
    }
}
