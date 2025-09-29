@extends('layouts.admin')

@section('title', 'Daftar Paket')

@section('content_header')
    <h1>Daftar Paket</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('paket.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Paket
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
                        <th>Nama Paket</th>
                        <th>Harga Dasar</th>
                        <th>Estimasi Waktu</th>
                        <th>Populer</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($paket as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->NamaPaket }}</td>
                            <td>Rp {{ number_format($item->HargaDasar, 0, ',', '.') }}</td>
                            <td>{{ $item->EstimasiWaktu }}</td>
                            <td>{!! $item->IsPopuler ? '<span class="badge badge-success">Ya</span>' : '<span class="badge badge-secondary">Tidak</span>' !!}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('paket.show', $item->PaketID) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('paket.edit', $item->PaketID) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('paket.destroy', $item->PaketID) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                            <td colspan="6" class="text-center">Tidak ada data paket</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $paket->links() }}
            </div>
        </div>
    </div>
@stop