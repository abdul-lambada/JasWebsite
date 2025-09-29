@extends('layouts.admin')

@section('title', 'Tambah Klien')

@section('content_header')
    <h1>Tambah Klien</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('klien.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="Nama">Nama</label>
                    <input type="text" name="Nama" id="Nama" class="form-control @error('Nama') is-invalid @enderror" value="{{ old('Nama') }}" required>
                    @error('Nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" name="Email" id="Email" class="form-control @error('Email') is-invalid @enderror" value="{{ old('Email') }}" required>
                    @error('Email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="NoTelepon">No Telepon</label>
                    <input type="text" name="NoTelepon" id="NoTelepon" class="form-control @error('NoTelepon') is-invalid @enderror" value="{{ old('NoTelepon') }}" required>
                    @error('NoTelepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="JenisKlien">Jenis Klien</label>
                    <select name="JenisKlien" id="JenisKlien" class="form-control @error('JenisKlien') is-invalid @enderror" required>
                        <option value="">Pilih Jenis Klien</option>
                        <option value="Perusahaan" {{ old('JenisKlien') == 'Perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                        <option value="Perorangan" {{ old('JenisKlien') == 'Perorangan' ? 'selected' : '' }}>Perorangan</option>
                        <option value="Instansi" {{ old('JenisKlien') == 'Instansi' ? 'selected' : '' }}>Instansi</option>
                    </select>
                    @error('JenisKlien')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="TanggalRegistrasi">Tanggal Registrasi</label>
                    <input type="date" name="TanggalRegistrasi" id="TanggalRegistrasi" class="form-control @error('TanggalRegistrasi') is-invalid @enderror" value="{{ old('TanggalRegistrasi', date('Y-m-d')) }}" required>
                    @error('TanggalRegistrasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('klien.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@stop