@extends('layouts.app')

@section('title', 'Data Instansi')

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Instansi</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('instansi.tambah') }}" class="btn btn-primary mb-3">Tambah Instansi</a>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Instansi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 0)
                    @foreach ($data as $row)
                    <tr>
                        {{-- <th>{{ $no++ }}</th> --}}
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $row->nama_instansi }}</td>
                        <td>
                            <a href="{{ route('instansi.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('instansi.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
