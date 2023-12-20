@extends('layouts.app')

@section('title', 'Data Skema')

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data skema</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('skema.tambah') }}" class="btn btn-primary mb-3">Tambah Skema</a>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Skema</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 0)
                    @foreach ($data as $row)
                    <tr>
                        {{-- <th>{{ $no++ }}</th> --}}
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $row->nama_skema }}</td>
                        <!-- <td>{{ $row->email }}</td> -->
                        <td>
                            <a href="{{ route('skema.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('skema.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
