@extends('layouts.app')

@section('title', 'Form Riwayat Magang')

@section('contents')
    <form action="{{ isset($magang) ? route('magang.tambah.update', $magang->id) : route('magang.tambah.simpan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($magang) ? 'Form Edit Riwayat Magang' : 'Form Tambah Riwayat Magang' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="topik_magang">Topik Magang</label>
                            <input type="text" class="form-control" id="topik_magang" name="topik_magang" value="{{ isset($magang) ? $magang->topik_magang : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="skema">Skema</label>
                            <input type="text" class="form-control" id="skema" name="skema" value="{{ isset($magang) ? $magang->skema : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="instansi">Instansi</label>
                            <input type="text" class="form-control" id="instansi" name="instansi" value="{{ isset($magang) ? $magang->instansi : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_penerbitan">Tanggal Penerbitan</label>
                            <input type="date" class="form-control" id="tgl_penerbitan" name="tgl_penerbitan" value="{{ isset($magang) ? $magang->tgl_penerbitan : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="masa_berlaku">Masa Berlaku</label>
                            <input type="date" class="form-control" id="masa_berlaku" name="masa_berlaku" value="{{ isset($magang) ? $magang->masa_berlaku : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="sertifikat">Sertifikat</label>
                            <input type="text" class="form-control" id="sertifikat" name="sertifikat" value="{{ isset($magang) ? $magang->sertifikat : '' }}">
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