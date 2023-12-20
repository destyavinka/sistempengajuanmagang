@extends('layouts.app')

@section('title', 'Form skema')

@section('contents')
    <form action="{{ isset($skema) ? route('skema.tambah.update', $skema->id) : route('skema.tambah.simpan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($skema) ? 'Form Edit skema' : 'Form Tambah skema' }}</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="nama_skema">Nama skema</label>
                            <input type="text" class="form-control" id="nama_skema" name="nama_skema" value="{{ isset($skema) ? $skema->nama_skema : '' }}">
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