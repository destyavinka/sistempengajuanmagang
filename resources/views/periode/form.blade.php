@extends('layouts.app')

@section('title', 'Form Periode')

@section('contents')
    <form action="{{ isset($periode) ? route('periode.tambah.update', $periode->id) : route('periode.tambah.simpan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($periode) ? 'Form Edit Periode' : 'Form Tambah Periode' }}</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" class="form-control" id="semester" name="semester" value="{{ isset($periode) ? $periode->semester : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="number" class="form-control" id="tahun" name="tahun" value="{{ isset($periode) ? $periode->tahun : '' }}">
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