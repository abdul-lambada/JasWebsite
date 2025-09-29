@extends('layouts.admin')

@section('title', 'Edit Anggota Tim')

@section('content_header')
    <h1>Edit Anggota Tim</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tim.update', $tim->TimID) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="Nama">Nama</label>
                    <input type="text" name="Nama" id="Nama" class="form-control @error('Nama') is-invalid @enderror" value="{{ old('Nama', $tim->Nama) }}" required>
                    @error('Nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="Jabatan">Jabatan</label>
                    <input type="text" name="Jabatan" id="Jabatan" class="form-control @error('Jabatan') is-invalid @enderror" value="{{ old('Jabatan', $tim->Jabatan) }}" required>
                    @error('Jabatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="URLFoto">Foto</label>
                    @if ($tim->URLFoto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $tim->URLFoto) }}" alt="{{ $tim->Nama }}" class="img-thumbnail" width="100">
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="URLFoto" id="URLFoto" class="custom-file-input @error('URLFoto') is-invalid @enderror">
                            <label class="custom-file-label" for="URLFoto">Pilih file baru (opsional)</label>
                        </div>
                    </div>
                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                    @error('URLFoto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="LinkLinkedin">Link LinkedIn</label>
                    <input type="url" name="LinkLinkedin" id="LinkLinkedin" class="form-control @error('LinkLinkedin') is-invalid @enderror" value="{{ old('LinkLinkedin', $tim->LinkLinkedin) }}" placeholder="https://linkedin.com/in/username">
                    @error('LinkLinkedin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="Keahlian">Keahlian</label>
                    <input type="text" name="Keahlian" id="Keahlian" class="form-control @error('Keahlian') is-invalid @enderror" value="{{ old('Keahlian', $tim->Keahlian) }}" placeholder="Contoh: Web Development, UI/UX Design, Digital Marketing" required>
                    @error('Keahlian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('tim.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
    // Script untuk menampilkan nama file yang dipilih
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>
@stop