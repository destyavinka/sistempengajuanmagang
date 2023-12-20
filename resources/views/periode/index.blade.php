@extends('layouts.app')

@section('title', 'Data Periode')

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Periode</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('periode.tambah') }}" class="btn btn-primary mb-3">Tambah Periode</a>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Semester</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 0)
                    @foreach ($data as $row)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $row->semester}}</td>
                        <td>{{ $row->tahun}}</td>
                        <td>
                            <a href="{{ route('periode.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('periode.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
