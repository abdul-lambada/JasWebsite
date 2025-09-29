@extends('layouts.admin')

@section('title', 'Edit Klien')

@section('content_header')
    <h1>Edit Klien</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('klien.update', $klien->KlienID) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="Nama">Nama</label>
                    <input type="text" name="Nama" id="Nama" class="form-control @error('Nama') is-invalid @enderror" value="{{ old('Nama', $klien->Nama) }}" required>
                    @error('Nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" name="Email" id="Email" class="form-control @error('Email') is-invalid @enderror" value="{{ old('Email', $klien->Email) }}" required>
                    @error('Email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="NoTelepon">No Telepon</label>
                    <input type="text" name="NoTelepon" id="NoTelepon" class="form-control @error('NoTelepon') is-invalid @enderror" value="{{ old('NoTelepon', $klien->NoTelepon) }}" required>
                    @error('NoTelepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="JenisKlien">Jenis Klien</label>
                    <select name="JenisKlien" id="JenisKlien" class="form-control @error('JenisKlien') is-invalid @enderror" required>
                        <option value="">Pilih Jenis Klien</option>
                        <option value="Perusahaan" {{ old('JenisKlien', $klien->JenisKlien) == 'Perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                        <option value="Perorangan" {{ old('JenisKlien', $klien->JenisKlien) == 'Perorangan' ? 'selected' : '' }}>Perorangan</option>
                        <option value="Instansi" {{ old('JenisKlien', $klien->JenisKlien) == 'Instansi' ? 'selected' : '' }}>Instansi</option>
                    </select>
                    @error('JenisKlien')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="TanggalRegistrasi">Tanggal Registrasi</label>
                    <input type="date" name="TanggalRegistrasi" id="TanggalRegistrasi" class="form-control @error('TanggalRegistrasi') is-invalid @enderror" value="{{ old('TanggalRegistrasi', $klien->TanggalRegistrasi) }}" required>
                    @error('TanggalRegistrasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('klien.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@stop