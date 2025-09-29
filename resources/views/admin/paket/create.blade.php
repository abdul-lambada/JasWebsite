@extends('layouts.admin')

@section('title', 'Tambah Paket')

@section('content_header')
    <h1>Tambah Paket</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('paket.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="NamaPaket">Nama Paket</label>
                    <input type="text" name="NamaPaket" id="NamaPaket" class="form-control @error('NamaPaket') is-invalid @enderror" value="{{ old('NamaPaket') }}" required>
                    @error('NamaPaket')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="Deskripsi">Deskripsi</label>
                    <textarea name="Deskripsi" id="Deskripsi" rows="4" class="form-control @error('Deskripsi') is-invalid @enderror" required>{{ old('Deskripsi') }}</textarea>
                    @error('Deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="HargaDasar">Harga Dasar</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" name="HargaDasar" id="HargaDasar" class="form-control @error('HargaDasar') is-invalid @enderror" value="{{ old('HargaDasar') }}" required>
                    </div>
                    @error('HargaDasar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="EstimasiWaktu">Estimasi Waktu</label>
                    <input type="text" name="EstimasiWaktu" id="EstimasiWaktu" class="form-control @error('EstimasiWaktu') is-invalid @enderror" value="{{ old('EstimasiWaktu') }}" placeholder="Contoh: 2-3 minggu" required>
                    @error('EstimasiWaktu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="IsPopuler" id="IsPopuler" class="custom-control-input" value="1" {{ old('IsPopuler') ? 'checked' : '' }}>
                        <label for="IsPopuler" class="custom-control-label">Tandai sebagai Paket Populer</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('paket.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@stop