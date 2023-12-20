@extends('layouts.app')

@section('title', 'Form Pekerti')

@section('contents')
    <form action="{{ isset($pekerti) ? route('pekerti.tambah.update', $pekerti->id) : route('pekerti.tambah.simpan') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($pekerti) ? 'Form Edit Pekerti' : 'Form Tambah Pekerti' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tgl_pelaksanaan">Tanggal Pelaksanaan</label>
                            <input type="date" class="form-control" id="tgl_pelaksanaan" name="tgl_pelaksanaan" value="{{ isset($pekerti) ? $pekerti->tgl_pelaksanaan : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="sertifikat">Sertifikat</label>
                            <input type="file" class="form-control" id="sertifikat" name="sertifikat" value="{{ isset($pekerti) ? $pekerti->sertifikat : '' }}">
                        </div>

                        @isset($pekerti)   
                        <div class="form-group">
                          <label for="status_pekerti">Status</label>
                          <select class="form-control"  id="status_pekerti" name="status_pekerti" >
                            <option value="{{ isset($pekerti) ? $pekerti->status_pekerti : '' }}">{{$pekerti->status_pekerti}}    </option>
                            <option value="Belum Disetujui">Belum Disetujui</option>
                            <option value="Sudah Disetujui">Sudah Disetujui</option>
                          </select>
                        </div>
                        
                        @else
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="status_pekerti" name="status_pekerti" value="Belum Disetujui">
                        </div>
                        @endif
                        
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