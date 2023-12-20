@extends('layouts.app')

@section('title', 'Data Periode')

@section('contents')
<form action="{{ route('profil.update')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Profil</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$user->nama}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{$user->nip}}">
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select class="form-control"  id="unit" name="unit">
                        <option value="" disabled selected>Pilih Unit</option>
                        @foreach($unit as $u)
                        <option value="{{$u->nama_unit}}" {{ $user->unit == $u->nama_unit ? 'selected' : '' }}>{{$u->nama_unit}}</option>
                        @endforeach
                        </select >
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
