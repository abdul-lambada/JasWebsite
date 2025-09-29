@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Proyek Baru</h1>
        <a href="{{ route('proyek.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Proyek</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('proyek.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="PesananID">Pesanan <span class="text-danger">*</span></label>
                    <select class="form-control @error('PesananID') is-invalid @enderror" id="PesananID" name="PesananID" required>
                        <option value="">-- Pilih Pesanan --</option>
                        @foreach($pesanan as $p)
                        <option value="{{ $p->PesananID }}" {{ old('PesananID', $pesanan_id) == $p->PesananID ? 'selected' : '' }}>
                            {{ $p->klien->Nama }} - {{ $p->paket->NamaPaket }} ({{ $p->TanggalPesanan }})
                        </option>
                        @endforeach
                    </select>
                    @error('PesananID')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="NamaProyek">Nama Proyek <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('NamaProyek') is-invalid @enderror" id="NamaProyek" name="NamaProyek" value="{{ old('NamaProyek') }}" required>
                    @error('NamaProyek')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="URLGambar">Gambar Proyek</label>
                    <input type="file" class="form-control-file @error('URLGambar') is-invalid @enderror" id="URLGambar" name="URLGambar">
                    <small class="form-text text-muted">Format: JPG, JPEG, PNG. Maks: 2MB</small>
                    @error('URLGambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="URLWebsite">URL Website</label>
                    <input type="url" class="form-control @error('URLWebsite') is-invalid @enderror" id="URLWebsite" name="URLWebsite" value="{{ old('URLWebsite') }}" placeholder="https://example.com">
                    @error('URLWebsite')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="tim">Tim yang Mengerjakan <span class="text-danger">*</span></label>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach($tim as $t)
                                <div class="col-md-4 mb-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="tim_{{ $t->TimID }}" name="tim[]" value="{{ $t->TimID }}" {{ in_array($t->TimID, old('tim', [])) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="tim_{{ $t->TimID }}">
                                            {{ $t->Nama }} ({{ $t->Jabatan }})
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @error('tim')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('proyek.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection