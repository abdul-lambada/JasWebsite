@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Artikel Blog</h1>
        <div>
            <a href="{{ route('artikel-blog.edit', $artikelBlog->ArtikelID) }}" class="btn btn-sm btn-primary">
                <i class="fa fa-edit fa-sm"></i> Edit
            </a>
            <a href="{{ route('artikel-blog.index') }}" class="btn btn-sm btn-secondary">
                <i class="fa fa-arrow-left fa-sm"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $artikelBlog->Judul }}</h6>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">ID Artikel</th>
                            <td>{{ $artikelBlog->ArtikelID }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $artikelBlog->Judul }}</td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <td>
                                @if($artikelBlog->penulis)
                                <a href="{{ route('tim.show', $artikelBlog->PenulisID) }}">
                                    {{ $artikelBlog->penulis->Nama }} ({{ $artikelBlog->penulis->Jabatan }})
                                </a>
                                @else
                                <span class="text-muted">Penulis tidak ditemukan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Publikasi</th>
                            <td>{{ date('d F Y H:i', strtotime($artikelBlog->TanggalPublikasi)) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Konten Artikel</h6>
                        </div>
                        <div class="card-body">
                            <div class="article-content">
                                {!! $artikelBlog->Konten !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .article-content {
        line-height: 1.8;
    }
    .article-content img {
        max-width: 100%;
        height: auto;
        margin: 1rem 0;
    }
    .article-content h1, 
    .article-content h2, 
    .article-content h3, 
    .article-content h4, 
    .article-content h5, 
    .article-content h6 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }
</style>
@endpush
@endsection