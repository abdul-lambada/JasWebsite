@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Testimoni</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Testimoni</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('testimoni.update', $testimoni->TestimoniID) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="ProyekID">Proyek <span class="text-danger">*</span></label>
                    <select class="form-control @error('ProyekID') is-invalid @enderror" id="ProyekID" name="ProyekID" required>
                        <option value="">Pilih Proyek</option>
                        @foreach($proyeks as $proyek)
                        <option value="{{ $proyek->ProyekID }}" {{ old('ProyekID', $testimoni->ProyekID) == $proyek->ProyekID ? 'selected' : '' }}>
                            {{ $proyek->NamaProyek }} ({{ $proyek->pesanan->klien->NamaKlien ?? 'N/A' }})
                        </option>
                        @endforeach
                    </select>
                    @error('ProyekID')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Nama">Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama" name="Nama" value="{{ old('Nama', $testimoni->Nama) }}" required>
                    @error('Nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Jabatan">Jabatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('Jabatan') is-invalid @enderror" id="Jabatan" name="Jabatan" value="{{ old('Jabatan', $testimoni->Jabatan) }}" required>
                    @error('Jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Isi">Isi Testimoni <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('Isi') is-invalid @enderror" id="Isi" name="Isi" rows="4" required>{{ old('Isi', $testimoni->Isi) }}</textarea>
                    @error('Isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Rating">Rating <span class="text-danger">*</span></label>
                    <div class="rating-input">
                        @for($i = 5; $i >= 1; $i--)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Rating" id="rating{{ $i }}" value="{{ $i }}" {{ old('Rating', $testimoni->Rating) == $i ? 'checked' : '' }} required>
                            <label class="form-check-label" for="rating{{ $i }}">
                                {{ $i }} <i class="fas fa-star text-warning"></i>
                            </label>
                        </div>
                        @endfor
                    </div>
                    @error('Rating')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="TanggalDiberikan">Tanggal Diberikan</label>
                    <input type="date" class="form-control @error('TanggalDiberikan') is-invalid @enderror" id="TanggalDiberikan" name="TanggalDiberikan" value="{{ old('TanggalDiberikan', $testimoni->TanggalDiberikan ? date('Y-m-d', strtotime($testimoni->TanggalDiberikan)) : date('Y-m-d')) }}">
                    @error('TanggalDiberikan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('testimoni.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection