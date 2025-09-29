@extends('layouts.admin')

@section('title', 'Detail Klien')

@section('content_header')
    <h1>Detail Klien</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200">ID Klien</th>
                    <td>{{ $klien->KlienID }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $klien->Nama }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $klien->Email }}</td>
                </tr>
                <tr>
                    <th>No Telepon</th>
                    <td>{{ $klien->NoTelepon }}</td>
                </tr>
                <tr>
                    <th>Jenis Klien</th>
                    <td>{{ $klien->JenisKlien }}</td>
                </tr>
                <tr>
                    <th>Tanggal Registrasi</th>
                    <td>{{ date('d/m/Y', strtotime($klien->TanggalRegistrasi)) }}</td>
                </tr>
            </table>
            
            <div class="mt-3">
                <a href="{{ route('klien.edit', $klien->KlienID) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('klien.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@stop