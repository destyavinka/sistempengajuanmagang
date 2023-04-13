@extends('layouts.app')

@section('title', 'Data Unit')

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Unit</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('unit.tambah') }}" class="btn btn-primary mb-3">Tambah Barang</a>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Unit</th>
                        <th>No Telepon</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 0)
                    @foreach ($data as $row)
                    <tr>
                        {{-- <th>{{ $no++ }}</th> --}}
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $row->nama_unit }}</td>
                        <td>{{ $row->nomor_telepon }}</td>
                        <td>{{ $row->email }}</td>
                        <td>
                            <a href="{{ route('unit.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('unit.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
