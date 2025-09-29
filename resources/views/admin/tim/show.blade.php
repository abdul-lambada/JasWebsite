@extends('layouts.admin')

@section('title', 'Detail Anggota Tim')

@section('content_header')
    <h1>Detail Anggota Tim</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    @if ($tim->URLFoto)
                        <img src="{{ asset('storage/' . $tim->URLFoto) }}" alt="{{ $tim->Nama }}" class="img-fluid rounded" style="max-height: 250px;">
                    @else
                        <img src="{{ asset('AdminLTE/dist/img/user-default.png') }}" alt="Default" class="img-fluid rounded" style="max-height: 250px;">
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">ID</th>
                            <td>{{ $tim->TimID }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $tim->Nama }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $tim->Jabatan }}</td>
                        </tr>
                        <tr>
                            <th>Keahlian</th>
                            <td>{{ $tim->Keahlian }}</td>
                        </tr>
                        <tr>
                            <th>LinkedIn</th>
                            <td>
                                @if ($tim->LinkLinkedin)
                                    <a href="{{ $tim->LinkLinkedin }}" target="_blank">
                                        {{ $tim->LinkLinkedin }}
                                        <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="mt-4">
                <h4>Proyek yang Dikerjakan</h4>
                @if ($tim->proyeks->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Proyek</th>
                                    <th>Status</th>
                                    <th>Tanggal Mulai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tim->proyeks as $index => $proyek)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <a href="{{ route('proyek.show', $proyek->ProyekID) }}">
                                                {{ $proyek->NamaProyek }}
                                            </a>
                                        </td>
                                        <td>{{ $proyek->Status }}</td>
                                        <td>{{ $proyek->TanggalMulai }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">Belum ada proyek yang dikerjakan.</p>
                @endif
            </div>
            
            <div class="mt-4">
                <h4>Artikel yang Ditulis</h4>
                @if ($tim->artikelBlogs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Publikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tim->artikelBlogs as $index => $artikel)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <a href="{{ route('artikel-blog.show', $artikel->ArtikelID) }}">
                                                {{ $artikel->Judul }}
                                            </a>
                                        </td>
                                        <td>{{ $artikel->Kategori }}</td>
                                        <td>{{ $artikel->TanggalPublikasi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">Belum ada artikel yang ditulis.</p>
                @endif
            </div>
            
            <div class="mt-3">
                <a href="{{ route('tim.edit', $tim->TimID) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('tim.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@stop