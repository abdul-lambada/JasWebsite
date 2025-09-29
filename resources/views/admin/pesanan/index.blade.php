@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content_header')
    <h1>Manajemen Pesanan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('pesanan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Pesanan
                </a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Klien</th>
                            <th>Paket</th>
                            <th>Tanggal Pesanan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesanan as $index => $item)
                            <tr>
                                <td>{{ $index + $pesanan->firstItem() }}</td>
                                <td>{{ $item->klien->Nama }}</td>
                                <td>{{ $item->paket->NamaPaket }}</td>
                                <td>{{ date('d/m/Y', strtotime($item->TanggalPesanan)) }}</td>
                                <td>
                                    @if($item->Status == 'Pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($item->Status == 'Diproses')
                                        <span class="badge badge-info">Diproses</span>
                                    @elseif($item->Status == 'Selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($item->Status == 'Dibatalkan')
                                        <span class="badge badge-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('pesanan.show', $item->PesananID) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pesanan.edit', $item->PesananID) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pesanan.destroy', $item->PesananID) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
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
                                <td colspan="6" class="text-center">Tidak ada data pesanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $pesanan->links() }}
            </div>
        </div>
    </div>
@stop