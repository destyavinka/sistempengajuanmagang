@extends('layouts.app')

@section('title', 'Form Unit')

@section('contents')
    <form action="{{ isset($unit) ? route('unit.tambah.update', $unit->id) : route('unit.tambah.simpan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($unit) ? 'Form Edit Unit' : 'Form Tambah Unit' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_unit">Nama Unit</label>
                            <input type="text" class="form-control" id="nama_unit" name="nama_unit" value="{{ isset($unit) ? $unit->nama_unit : '' }}">
                        </div>
                        {{-- <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ isset($unit) ? $unit->nomor_telepon : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ isset($unit) ? $unit->email : '' }}">
                        </div>
                    </div> --}}
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection