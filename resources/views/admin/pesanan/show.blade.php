@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content_header')
    <h1>Detail Pesanan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200">ID Pesanan</th>
                    <td>{{ $pesanan->PesananID }}</td>
                </tr>
                <tr>
                    <th>Klien</th>
                    <td>
                        <a href="{{ route('klien.show', $pesanan->klien->KlienID) }}">
                            {{ $pesanan->klien->Nama }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Paket</th>
                    <td>
                        <a href="{{ route('paket.show', $pesanan->paket->PaketID) }}">
                            {{ $pesanan->paket->NamaPaket }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Harga Paket</th>
                    <td>Rp {{ number_format($pesanan->paket->HargaDasar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pesanan</th>
                    <td>{{ date('d/m/Y', strtotime($pesanan->TanggalPesanan)) }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($pesanan->Status == 'Pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($pesanan->Status == 'Diproses')
                            <span class="badge badge-info">Diproses</span>
                        @elseif($pesanan->Status == 'Selesai')
                            <span class="badge badge-success">Selesai</span>
                        @elseif($pesanan->Status == 'Dibatalkan')
                            <span class="badge badge-danger">Dibatalkan</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Proyek Terkait</th>
                    <td>
                        @if($pesanan->proyek)
                            <a href="{{ route('proyek.show', $pesanan->proyek->ProyekID) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-external-link"></i> Lihat Proyek #{{ $pesanan->proyek->ProyekID }}
                            </a>
                        @else
                            <span class="text-muted">Belum ada proyek terkait</span>
                            <a href="{{ route('proyek.create') }}?pesanan_id={{ $pesanan->PesananID }}" class="btn btn-sm btn-success ml-2">
                                <i class="fa fa-plus"></i> Buat Proyek
                            </a>
                        @endif
                    </td>
                </tr>
            </table>
            
            <div class="mt-3">
                <a href="{{ route('pesanan.edit', $pesanan->PesananID) }}" class="btn btn-warning">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@stop