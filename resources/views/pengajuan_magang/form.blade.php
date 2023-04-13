@extends('layouts.app')

@section('title', 'Form Pengajuan Magang')

@section('contents')
    <form action="{{ isset($pengajuan_magang) ? route('pengajuan_magang.tambah.update', $pengajuan_magang->id) : route('pengajuan_magang.tambah.simpan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($pengajuan_magang) ? 'Form Edit Pengajuan Magang' : 'Form Tambah Pengajuan Magang' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="topik_magang">Topik Magang</label>
                            <input type="text" class="form-control" id="topik_magang" name="topik_magang" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->topik_magang : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="skema">Skema</label>
                            <input type="text" class="form-control" id="skema" name="skema" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->skema : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="instansi">Instansi</label>
                            <input type="text" class="form-control" id="instansi" name="instansi" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->instansi : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->tgl_mulai : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->tgl_selesai : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="anggaran">Anggaran</label>
                            <input type="text" class="form-control" id="anggaran" name="anggaran" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->anggaran : '' }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection