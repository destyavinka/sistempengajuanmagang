@extends('layouts.app')

@section('title', 'Data Pekerti')

@section('contents')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pekerti</h6>
    </div>
    <div class="card-body">

        <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('pekerti.tambah') }}" class="btn btn-primary mb-3">Tambah Riwayat</a>
        @if(auth()->user()->level != "Tenaga Pendidik" && auth()->user()->level != "Tenaga Kependidikan")
                <a href="{{ route('pengajuan_magang.export') }}" class="btn btn-success">Export ke Excel</a>
        @endif
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Sertifikat</th>
                        <th>Status Pengajuan</th>
                        @if(auth()->user()->level==1)
                        <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($no = 0)
                    @foreach ($data as $row)
                    <tr>
                        {{-- <th>{{ $no++ }}</th> --}}
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $row->tgl_pelaksanaan }}</td>
                        <td>{{ $row->sertifikat }}</td>
                        @if ($row->status_pekerti=="Belum Disetujui")
                            <td ><span class="badge badge-danger btn-sm">{{ $row->status_pekerti }}</span></td>
                        @else
                            <td ><span class="badge badge-success btn-sm">{{ $row->status_pekerti }}</span></td>
                        @endif

                        @if(auth()->user()->level==1)
                        <td>
                            <div class="d-flex justify-content-between">

                                <a class="btn btn-outline-warning" href="{{ route('pekerti.edit', $row->id) }}" > 
                                <span><i class="ti-pencil"></i>Edit</span>
                                </a>
                                <a class="btn btn-outline-danger ml-1" href="{{ route('pekerti.hapus', $row->id) }}" class=""> 
                                    <span><i class="ti-trash"></i>Delete</span>
                                </a>
                            </div>
                        </td>      
                        @endif                
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
