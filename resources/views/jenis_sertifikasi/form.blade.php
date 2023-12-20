@extends('layouts.app')

@section('title', 'Form Jenis Sertifikasi')

@section('contents')
    <form action="{{ isset($jenis_sertifikasi) ? route('jenis_sertifikasi.tambah.update', $jenis_sertifikasi->id) : route('jenis_sertifikasi.tambah.simpan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($jenis_sertifikasi) ? 'Form Edit Tingkat Sertifikasi' : 'Form Tambah Tingkat Sertifikasi' }}</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="jenis_sertifikasi">Tingkat Sertifikasi</label>
                            <input type="text" class="form-control" id="jenis_sertifikasi" name="jenis_sertifikasi" value="{{ isset($jenis_sertifikasi) ? $jenis_sertifikasi->jenis_sertifikasi : '' }}">
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