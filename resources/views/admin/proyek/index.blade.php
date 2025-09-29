@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Proyek</h1>
        <a href="{{ route('proyek.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Proyek
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Proyek</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Proyek</th>
                            <th>Klien</th>
                            <th>Paket</th>
                            <th>Tim</th>
                            <th>Gambar</th>
                            <th>Website</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($proyek as $index => $item)
                        <tr>
                            <td>{{ $index + $proyek->firstItem() }}</td>
                            <td>{{ $item->NamaProyek }}</td>
                            <td>{{ $item->pesanan->klien->Nama ?? 'N/A' }}</td>
                            <td>{{ $item->pesanan->paket->NamaPaket ?? 'N/A' }}</td>
                            <td>
                                @if($item->tims->count() > 0)
                                    <span class="badge badge-info">{{ $item->tims->count() }} anggota</span>
                                @else
                                    <span class="badge badge-warning">Belum ada tim</span>
                                @endif
                            </td>
                            <td>
                                @if($item->URLGambar)
                                    <img src="{{ asset('storage/'.$item->URLGambar) }}" alt="{{ $item->NamaProyek }}" width="50">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>
                                @if($item->URLWebsite)
                                    <a href="{{ $item->URLWebsite }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada URL</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('proyek.show', $item->ProyekID) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('proyek.edit', $item->ProyekID) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('proyek.destroy', $item->ProyekID) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data proyek</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $proyek->links() }}
            </div>
        </div>
    </div>
</div>
@endsection