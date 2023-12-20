@extends('layouts.app')

@section('title', 'Form User')

@section('contents')
{{-- {{ isset($user) ? route('user.tambah.update', $user->id) : route('user.tambah.simpan') }} --}}
    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($user) ? 'Form Edit User' : 'Form Tambah User' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ isset($user) ? $user->nama : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" value="{{ isset($user) ? $user->nama : '' }}">
                        </div>

                        <div class="form-group" >
                            <label for="unit">Unit</label>
                            <select class="form-control"  id="unit" name="unit" >
                              <option value="" disabled selected>Pilih Unit</option>
                              @foreach($unit as $sk)
                              <option value="{{$sk->nama_unit}}" {{ isset($sk) && $sk->id == $sk->id ? 'selected' : '' }}>{{$sk->nama_unit}}</option>
                              @endforeach
                            </select >
                          </div>

                          <div class="form-group" >
                            <label for="level">Role</label>
                            <select class="form-control"  id="level" name="level" >
                              <option value="" disabled selected>Pilih Role</option>
                              @foreach($role as $sk)
                              <option value="{{$sk->role}}" {{ isset($sk) && $sk->id == $sk->id ? 'selected' : '' }}>{{$sk->role}}</option>
                              @endforeach
                            </select >
                          </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ isset($user) ? $user->email : '' }}"
                            pattern=".+@staff\.uns\.ac\.id$" 
                            title="Mohon menggunakan format email @staff.uns.ac.id" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="{{ isset($user) ? $user->password : '' }}">
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