@extends('layouts.app')

@section('title', 'Data Pengajuan Magang')

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Magang</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('pengajuan_magang.tambah') }}" class="btn btn-primary mb-3">Tambah Pengajuan</a>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Topik Magang</th>
                        <th>Skema</th>
                        <th>Instansi</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Anggaran</th>
                        <th>Status Pengajuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 0)
                    @foreach ($data as $row)
                    <tr>
                        {{-- <th>{{ $no++ }}</th> --}}
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $row->topik_magang }}</td>
                        <td>{{ $row->skema_id }}</td>
                        <td>{{ $row->instansi_id }}</td>
                        <td>{{ $row->tgl_mulai }}</td>
                        <td>{{ $row->tgl_selesai }}</td>
                        <td>{{ $row->anggaran }}</td>
                        <td>{{ $row->status_pengajuanmagang }}</td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('pengajuan_magang.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('pengajuan_magang.hapus', $row->id) }}" class="btn btn-danger ml-1">Hapus</a>
                            </div>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
