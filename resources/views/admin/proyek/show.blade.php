@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Proyek</h1>
        <div>
            <a href="{{ route('proyek.edit', $proyek->ProyekID) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
            </a>
            <a href="{{ route('proyek.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm ml-2">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Proyek</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%">ID Proyek</th>
                                <td>{{ $proyek->ProyekID }}</td>
                            </tr>
                            <tr>
                                <th>Nama Proyek</th>
                                <td>{{ $proyek->NamaProyek }}</td>
                            </tr>
                            <tr>
                                <th>Klien</th>
                                <td>{{ $proyek->pesanan->klien->Nama ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Paket</th>
                                <td>{{ $proyek->pesanan->paket->NamaPaket ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pesanan</th>
                                <td>{{ $proyek->pesanan->TanggalPesanan ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Status Pesanan</th>
                                <td>
                                    @if($proyek->pesanan)
                                        @php
                                            $statusClass = [
                                                'Pending' => 'warning',
                                                'Diproses' => 'info',
                                                'Selesai' => 'success',
                                                'Dibatalkan' => 'danger'
                                            ][$proyek->pesanan->Status] ?? 'secondary';
                                        @endphp
                                        <span class="badge badge-{{ $statusClass }}">{{ $proyek->pesanan->Status }}</span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>URL Website</th>
                                <td>
                                    @if($proyek->URLWebsite)
                                        <a href="{{ $proyek->URLWebsite }}" target="_blank">{{ $proyek->URLWebsite }}</a>
                                    @else
                                        <span class="text-muted">Tidak ada URL</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Tim yang Mengerjakan</h6>
                </div>
                <div class="card-body">
                    @if($proyek->tims->count() > 0)
                        <div class="row">
                            @foreach($proyek->tims as $tim)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            @if($tim->URLFoto)
                                                <img src="{{ asset('storage/'.$tim->URLFoto) }}" alt="{{ $tim->Nama }}" class="rounded-circle mr-3" style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mr-3" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-user fa-2x"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h5 class="card-title mb-1">{{ $tim->Nama }}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">{{ $tim->Jabatan }}</h6>
                                                <p class="card-text small mb-1">
                                                    <i class="fas fa-tools mr-1"></i> {{ $tim->Keahlian }}
                                                </p>
                                                @if($tim->LinkLinkedin)
                                                <a href="{{ $tim->LinkLinkedin }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fab fa-linkedin"></i> LinkedIn
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Belum ada tim yang ditugaskan untuk proyek ini.
                        </div>
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Testimoni</h6>
                    <a href="{{ route('testimoni.create', ['proyek_id' => $proyek->ProyekID]) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus fa-sm"></i> Tambah Testimoni
                    </a>
                </div>
                <div class="card-body">
                    @if($proyek->testimonis->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Isi Testimoni</th>
                                        <th>Rating</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proyek->testimonis as $index => $testimoni)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $testimoni->Nama }}</td>
                                        <td>{{ $testimoni->Jabatan }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($testimoni->Isi, 50) }}</td>
                                        <td>
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $testimoni->Rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('testimoni.edit', $testimoni->TestimoniID) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('testimoni.destroy', $testimoni->TestimoniID) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Belum ada testimoni untuk proyek ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Gambar Proyek</h6>
                </div>
                <div class="card-body text-center">
                    @if($proyek->URLGambar)
                        <img src="{{ asset('storage/'.$proyek->URLGambar) }}" alt="{{ $proyek->NamaProyek }}" class="img-fluid">
                    @else
                        <div class="alert alert-info">
                            Tidak ada gambar untuk proyek ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection