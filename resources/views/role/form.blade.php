@extends('layouts.app')

@section('title', 'Form Role')

@section('contents')
    <form action="{{ isset($role) ? route('role.tambah.update', $role->id) : route('role.tambah.simpan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($role) ? 'Form Edit Role' : 'Form Tambah Role' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" class="form-control" id="role" name="role" value="{{ isset($role) ? $role->role : '' }}">
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