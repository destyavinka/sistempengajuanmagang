@extends('layouts.app')

@section('title', 'Form Instansi')

@section('contents')
    <form action="{{ isset($instansi) ? route('instansi.tambah.update', $instansi->id) : route('instansi.tambah.simpan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($instansi) ? 'Form Edit Instansi' : 'Form Tambah Instansi' }}</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="nama_instansi">Nama Instansi</label>
                            <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" value="{{ isset($instansi) ? $instansi->nama_instansi : '' }}">
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