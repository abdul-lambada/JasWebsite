@extends('layouts.admin')

@section('title', 'Manajemen Tim')

@section('content_header')
    <h1>Manajemen Tim</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('tim.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Anggota Tim
                </a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Keahlian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tim as $index => $item)
                            <tr>
                                <td>{{ $index + $tim->firstItem() }}</td>
                                <td>
                                    @if ($item->URLFoto)
                                        <img src="{{ asset('storage/' . $item->URLFoto) }}" alt="{{ $item->Nama }}" class="img-thumbnail" width="50">
                                    @else
                                        <img src="{{ asset('AdminLTE/dist/img/user-default.png') }}" alt="Default" class="img-thumbnail" width="50">
                                    @endif
                                </td>
                                <td>{{ $item->Nama }}</td>
                                <td>{{ $item->Jabatan }}</td>
                                <td>{{ $item->Keahlian }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('tim.show', $item->TimID) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('tim.edit', $item->TimID) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('tim.destroy', $item->TimID) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data anggota tim</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $tim->links() }}
            </div>
        </div>
    </div>
@stop