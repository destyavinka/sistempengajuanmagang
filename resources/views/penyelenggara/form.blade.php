@extends('layouts.app')

@section('title', 'Form Penyelenggara Serkom')

@section('contents')
    <form action="{{ isset($penyelenggara) ? route('penyelenggara.tambah.update', $penyelenggara->id) : route('penyelenggara.tambah.simpan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($penyelenggara) ? 'Form Edit Penyelenggara' : 'Form Tambah Penyelenggara' }}</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="penyelenggara">Penyelenggara Sertifikasi Kompetensi</label>
                            <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" value="{{ isset($penyelenggara) ? $penyelenggara->penyelenggara : '' }}">
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