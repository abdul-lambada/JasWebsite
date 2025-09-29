@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Testimoni</h1>
        <div>
            <a href="{{ route('testimoni.edit', $testimoni->TestimoniID) }}" class="btn btn-sm btn-warning shadow-sm">
                <i class="fa fa-pencil text-white-50"></i> Edit
            </a>
            <a href="{{ route('testimoni.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fa fa-arrow-left text-white-50"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Testimoni</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%">ID Testimoni</th>
                                <td>{{ $testimoni->TestimoniID }}</td>
                            </tr>
                            <tr>
                                <th>Proyek</th>
                                <td>
                                    @if($testimoni->proyek)
                                        <a href="{{ route('proyek.show', $testimoni->ProyekID) }}">
                                            {{ $testimoni->proyek->NamaProyek }}
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $testimoni->Nama }}</td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>{{ $testimoni->Jabatan }}</td>
                            </tr>
                            <tr>
                                <th>Rating</th>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimoni->Rating)
                                            <i class="fa fa-star text-warning"></i>
                                        @else
                                            <i class="fa fa-star-o text-warning"></i>
                                        @endif
                                    @endfor
                                    ({{ $testimoni->Rating }}/5)
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Diberikan</th>
                                <td>{{ $testimoni->TanggalDiberikan ? date('d-m-Y', strtotime($testimoni->TanggalDiberikan)) : 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Klien</h6>
                </div>
                <div class="card-body">
                    @if($testimoni->proyek && $testimoni->proyek->pesanan && $testimoni->proyek->pesanan->klien)
                        <h5>{{ $testimoni->proyek->pesanan->klien->Nama }}</h5>
                        <p>{{ $testimoni->proyek->pesanan->klien->Email }}</p>
                        <p>{{ $testimoni->proyek->pesanan->klien->NoTelepon }}</p>
                    @else
                        <p class="text-muted">Informasi klien tidak tersedia</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Isi Testimoni</h6>
        </div>
        <div class="card-body">
            <blockquote class="blockquote">
                <p class="mb-0">{{ $testimoni->Isi }}</p>
                <footer class="blockquote-footer">{{ $testimoni->Nama }}, <cite title="Source Title">{{ $testimoni->Jabatan }}</cite></footer>
            </blockquote>
        </div>
    </div>
</div>
@endsection