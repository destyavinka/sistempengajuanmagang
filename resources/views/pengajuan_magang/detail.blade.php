@extends('layouts.app')

@section('title', 'Form Pengajuan Magang')

@section('contents')
    <form action="{{ isset($pengajuan_magang) ? route('pengajuan_magang.tambah.update', $pengajuan_magang->id) : route('pengajuan_magang.tambah.simpan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($pengajuan_magang) ? 'Form Edit Pengajuan Magang' : 'Form Tambah Pengajuan Magang' }}</h6>
                    </div>
                    
                    <div class="card-body">
                        
                        <input class="form-control mb-2" type="text" value="{{ $user->nama }} - {{ $user->unit }}" disabled style="font-weight: bold;">

                        <div class="form-group">
                            <label for="topik_magang"><br>Topik Magang</label>
                            <input type="text" class="form-control" id="topik_magang" name="topik_magang" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->topik_magang : '' }}">
                            </div>
                                                      
                          <label for="periode">Periode</label>
                          <select class="form-control" id="periode" name="periode" style="margin-bottom: 20px;">
                            <option value="" disabled selected>Pilih Periode</option>
                            @foreach ($periode as $periode)
                                <option value="{{ $periode->id }}" {{ isset($pengajuan_magang) && $pengajuan_magang->periode_id == $periode->id ? 'selected' : '' }} >
                                    {{ $periode->semester . ' ' . $periode->tahun }} 
                                </option>
                            @endforeach
                        </select>
                        
                        

                        <div class="form-group" >
                          <label for="skema">Skema</label>
                          <select class="form-control"  id="skema" name="skema">
                            <option value="" disabled selected>Pilih Skema</option>
                            @foreach($skema as $sk)
                            <option value="{{$sk->id}}" {{ isset($pengajuan_magang) && $pengajuan_magang->skema->id == $sk->id ? 'selected' : '' }}>{{$sk->nama_skema}}</option>
                            @endforeach
                          </select >
                        </div>
                        
                        <div class="form-group">
                          <label for="instansi">Instansi</label>
                          <select class="form-control"  id="instansi" name="instansi">
                            <option value="" disabled selected>Pilih Instansi</option>
                            @foreach($instansi as $sk)
                            <option value="{{$sk->id}}" {{ isset($pengajuan_magang) && $pengajuan_magang->instansi->id == $sk->id ? 'selected' : '' }}>{{$sk->nama_instansi}}</option>
                            @endforeach
                          </select >
                        </div>
                        
                        <div class="form-group">
                            <label for="tgl_daftar">Tanggal Daftar</label>
                            <input type="date" class="form-control" id="tgl_daftar" name="tgl_daftar" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->tgl_daftar : '' }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="tgl_pelaksanaan">Tanggal Pelaksaan</label>
                            <input type="date" class="form-control" id="tgl_pelaksanaan" name="tgl_pelaksanaan" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->tgl_pelaksanaan : '' }}">
                        </div>
                 
                        <div class="form-group">
                            <label for="pengajuan_anggaran">Anggaran Yang Diajukan</label>
                            <input type="text" class="form-control" id="pengajuan_anggaran" name="pengajuan_anggaran" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->pengajuan_anggaran : '' }}">
                        </div>

                        <div class="form-group">
                          <label for="keterangan_anggaran">Keterangan Keperluan Anggaran</label>
                          <textarea class="form-control" id="keterangan_anggaran" name="keterangan_anggaran" rows="4" cols="50">{{ isset($pengajuan_magang) ? $pengajuan_magang->keterangan_anggaran : '' }}</textarea>
                      </div>

                      <div class="form-group">
                        <label for="dokumen_dukung">Dokumen Dukung</label>
                        <br>
                        <a href="{{ asset('dokumen_dukung').'/'.$pengajuan_magang->dokumen_dukung }}">Lihat file {{ $pengajuan_magang->dokumen_dukung }}</a>
                        {{-- <input type="text" class="form-control" id="dokumen_dukung" name="dokumen_dukung" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->dokumen_dukung : '' }}"> --}}
                        </div>
                      
                        @if(auth()->user()->level=="Dekan" ||auth()->user()->level=="Admin Sekolah Vokasi" || auth()->user()->level=="Kaprodi" )
                        @isset($pengajuan_magang)   
                        <div class="form-group">
                          <label for="status_pengajuanmagang">Status</label>
                          <select class="form-control"  id="status_pengajuanmagang" name="status_pengajuanmagang" >
                            <option value="{{ isset($pengajuan_magang) ? $pengajuan_magang->status_pengajuanmagang : '' }}">{{$pengajuan_magang->status_pengajuanmagang}}    </option>
                            
                            @if($pengajuan_magang->status_pengajuanmagang == "Belum Disetujui" && (auth()->user()->level=="Kaprodi" || auth()->user()->level=="Admin Sekolah Vokasi") )
                            <option value="Menunggu Validasi">Menunggu Validasi</option>
                            @elseif($pengajuan_magang->status_pengajuanmagang == "Menunggu Validasi" && auth()->user()->level=="Dekan" )
                            <option value="Sudah Disetujui">Sudah Disetujui</option>
                            @else
                            <option value="Belum Disetujui">Belum Disetujui</option>
                            @endif
                          </select>
                        </div>
                        @endif
                        @else
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="status_pengajuanmagang" name="status_pengajuanmagang" value="Belum Disetujui">
                        </div>
                        @endif
                        
                    </div>

                    <div class="card-footer">
                        <a href="javascript:history.back()" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection