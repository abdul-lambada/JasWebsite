@extends('layouts.admin')

@section('title', 'Tambah Pesanan')

@section('content_header')
    <h1>Tambah Pesanan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pesanan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="KlienID">Klien</label>
                    <select name="KlienID" id="KlienID" class="form-control @error('KlienID') is-invalid @enderror" required>
                        <option value="">-- Pilih Klien --</option>
                        @foreach($klien as $k)
                            <option value="{{ $k->KlienID }}" {{ old('KlienID') == $k->KlienID ? 'selected' : '' }}>
                                {{ $k->Nama }} ({{ $k->Email }})
                            </option>
                        @endforeach
                    </select>
                    @error('KlienID')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="PaketID">Paket</label>
                    <select name="PaketID" id="PaketID" class="form-control @error('PaketID') is-invalid @enderror" required>
                        <option value="">-- Pilih Paket --</option>
                        @foreach($paket as $p)
                            <option value="{{ $p->PaketID }}" {{ old('PaketID') == $p->PaketID ? 'selected' : '' }}>
                                {{ $p->NamaPaket }} - Rp {{ number_format($p->HargaDasar, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('PaketID')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="TanggalPesanan">Tanggal Pesanan</label>
                    <input type="date" name="TanggalPesanan" id="TanggalPesanan" class="form-control @error('TanggalPesanan') is-invalid @enderror" value="{{ old('TanggalPesanan', date('Y-m-d')) }}" required>
                    @error('TanggalPesanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="Status">Status</label>
                    <select name="Status" id="Status" class="form-control @error('Status') is-invalid @enderror" required>
                        <option value="Pending" {{ old('Status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Diproses" {{ old('Status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ old('Status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Dibatalkan" {{ old('Status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('Status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
    $(function() {
        // Inisialisasi select2 jika tersedia
        if ($.fn.select2) {
            $('#KlienID, #PaketID').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih...",
                allowClear: true
            });
        }
    });
</script>
@stop