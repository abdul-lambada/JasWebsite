@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Proyek</h3>
        </div>
        <form action="{{ route('admin.proyek.update', $proyek->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Proyek</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $proyek->nama) }}" required>
                    @error('nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="klien">Klien</label>
                    <input type="text" class="form-control @error('klien') is-invalid @enderror" id="klien" name="klien" value="{{ old('klien', $proyek->klien) }}" required>
                    @error('klien')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi', $proyek->lokasi) }}" required>
                    @error('lokasi')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="{{ old('tahun', $proyek->tahun) }}" required>
                    @error('tahun')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                        <option value="">Pilih Kategori</option>
                        <option value="residensial" {{ old('kategori', $proyek->kategori) == 'residensial' ? 'selected' : '' }}>Residensial</option>
                        <option value="komersial" {{ old('kategori', $proyek->kategori) == 'komersial' ? 'selected' : '' }}>Komersial</option>
                        <option value="industrial" {{ old('kategori', $proyek->kategori) == 'industrial' ? 'selected' : '' }}>Industrial</option>
                        <option value="institusional" {{ old('kategori', $proyek->kategori) == 'institusional' ? 'selected' : '' }}>Institusional</option>
                    </select>
                    @error('kategori')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="luas">Luas Bangunan (m²)</label>
                    <input type="number" step="0.01" class="form-control @error('luas') is-invalid @enderror" id="luas" name="luas" value="{{ old('luas', $proyek->luas) }}">
                    @error('luas')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $proyek->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar Utama</label>
                    <input type="file" class="form-control-file @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                    @error('gambar')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    @if($proyek->gambar)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $proyek->gambar) }}" alt="Current Image" style="max-width: 200px;">
                            <p class="text-muted">Gambar saat ini</p>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="gambar_gallery">Gallery Gambar</label>
                    <input type="file" class="form-control-file @error('gambar_gallery.*') is-invalid @enderror" id="gambar_gallery" name="gambar_gallery[]" multiple accept="image/*">
                    @error('gambar_gallery.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small class="text-muted">Pilih beberapa gambar untuk gallery. Gambar sebelumnya akan tetap ada.</small>
                </div>

                @if($proyek->gallery && $proyek->gallery->count() > 0)
                    <div class="form-group">
                        <label>Gambar Gallery Saat Ini</label>
                        <div class="row">
                            @foreach($proyek->gallery as $gallery)
                                <div class="col-md-3 mb-2">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $gallery->gambar) }}" alt="Gallery Image" class="img-thumbnail" style="width: 100%; height: 150px; object-fit: cover;">
                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" onclick="deleteGallery({{ $gallery->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="aktif" {{ old('status', $proyek->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak_aktif" {{ old('status', $proyek->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.proyek.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function deleteGallery(id) {
    if(confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
        $.ajax({
            url: '{{ url("admin/proyek/gallery") }}/' + id,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat menghapus gambar');
            }
        });
    }
}
</script>
@endpush
@endsection
