@extends('layouts.app')

@section('title', 'Data Jenis Sertifikasi')

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Jenis Sertifikasi</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('jenis_sertifikasi.tambah') }}" class="btn btn-primary mb-3">Tambah Tingkat</a>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tingkat Sertifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 0)
                    @foreach ($data as $row)
                    <tr>
                        {{-- <th>{{ $no++ }}</th> --}}
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $row->jenis_sertifikasi }}</td>
                        <td>
                            <a href="{{ route('jenis_sertifikasi.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('jenis_sertifikasi.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
