@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Artikel Blog</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Artikel</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('artikel-blog.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="PenulisID">Penulis <span class="text-danger">*</span></label>
                    <select class="form-control @error('PenulisID') is-invalid @enderror" id="PenulisID" name="PenulisID" required>
                        <option value="">Pilih Penulis</option>
                        @foreach($penulis as $tim)
                        <option value="{{ $tim->TimID }}" {{ old('PenulisID') == $tim->TimID ? 'selected' : '' }}>
                            {{ $tim->Nama }} ({{ $tim->Jabatan }})
                        </option>
                        @endforeach
                    </select>
                    @error('PenulisID')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Judul">Judul Artikel <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('Judul') is-invalid @enderror" id="Judul" name="Judul" value="{{ old('Judul') }}" required>
                    @error('Judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Konten">Konten <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('Konten') is-invalid @enderror" id="Konten" name="Konten" rows="10" required>{{ old('Konten') }}</textarea>
                    @error('Konten')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="TanggalPublikasi">Tanggal Publikasi <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control @error('TanggalPublikasi') is-invalid @enderror" id="TanggalPublikasi" name="TanggalPublikasi" value="{{ old('TanggalPublikasi', date('Y-m-d\TH:i')) }}" required>
                    @error('TanggalPublikasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('artikel-blog.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize rich text editor for content
    $(document).ready(function() {
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('Konten');
        }
    });
</script>
@endpush
@endsection