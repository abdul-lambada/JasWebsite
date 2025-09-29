@extends('layouts.admin')

@section('title', 'Daftar Klien')

@section('content_header')
    <h1>Daftar Klien</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('klien.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Klien
                </a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Telepon</th>
                        <th>Jenis Klien</th>
                        <th>Tanggal Registrasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($klien as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->Nama }}</td>
                            <td>{{ $item->Email }}</td>
                            <td>{{ $item->NoTelepon }}</td>
                            <td>{{ $item->JenisKlien }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->TanggalRegistrasi)) }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('klien.show', $item->KlienID) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('klien.edit', $item->KlienID) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('klien.destroy', $item->KlienID) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data klien</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $klien->links() }}
            </div>
        </div>
    </div>
@stop