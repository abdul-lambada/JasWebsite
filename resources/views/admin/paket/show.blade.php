@extends('layouts.admin')

@section('title', 'Detail Paket')

@section('content_header')
    <h1>Detail Paket</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200">ID Paket</th>
                    <td>{{ $paket->PaketID }}</td>
                </tr>
                <tr>
                    <th>Nama Paket</th>
                    <td>{{ $paket->NamaPaket }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $paket->Deskripsi }}</td>
                </tr>
                <tr>
                    <th>Harga Dasar</th>
                    <td>Rp {{ number_format($paket->HargaDasar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Estimasi Waktu</th>
                    <td>{{ $paket->EstimasiWaktu }}</td>
                </tr>
                <tr>
                    <th>Paket Populer</th>
                    <td>{!! $paket->IsPopuler ? '<span class="badge badge-success">Ya</span>' : '<span class="badge badge-secondary">Tidak</span>' !!}</td>
                </tr>
            </table>
            
            <div class="mt-3">
                <a href="{{ route('paket.edit', $paket->PaketID) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('paket.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@stop