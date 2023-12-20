@extends('layouts.app')

@section('title', 'Form Pengajuan Serkom')

@section('contents')
    <form action="{{ isset($pengajuan_serkom) ? route('pengajuan_serkom.tambah.update', $pengajuan_serkom->id) : route('pengajuan_serkom.tambah.simpan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($pengajuan_serkom) ? 'Form Edit Pengajuan Serkom' : 'Form Tambah Pengajuan Serkom' }}</h6>
                    </div>
                    <div class="card-body">
                      <input class="form-control mb-2" type="text" value="{{ $user->nama }} - {{ $user->unit }}" disabled style="font-weight: bold;">
                        
                        <div class="form-group">
                            <label for="nama_sertifikasi">Nama Sertifikasi</label>
                            <input type="text" class="form-control" id="nama_sertifikasi" name="nama_sertifikasi" value="{{ isset($pengajuan_serkom) ? $pengajuan_serkom->nama_sertifikasi : '' }}" 
                            {{ Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan' ? 'readonly' : '' }} placeholder="Masukkan Nama Sertifikasi">
                        </div>

                        <label for="periode">Periode</label>
                          <select class="form-control" id="periode" name="periode" style="margin-bottom: 20px;" >
                            <option value="" disabled selected>Pilih Periode</option>
                            @foreach ($periode as $periode)
                                <option value="{{ $periode->id }}" {{ isset($pengajuan_serkom) && $pengajuan_serkom->periode_id == $periode->id ? 'selected' : '' }}>
                                    {{ $periode->semester . ' ' . $periode->tahun }}
                                </option>
                            @endforeach
                        </select>

                        <div class="form-group">
                          <label for="skema">Skema</label>
                          <select class="form-control"  id="skema" name="skema">
                            <option value="" disabled selected>Pilih Skema</option>
                            @foreach($skema as $sk)
                            <option value="{{$sk->id}}" {{ isset($pengajuan_serkom) && $pengajuan_serkom->skema->id == $sk->id ? 'selected' : '' }}>{{$sk->nama_skema}}</option>
                            @endforeach
                          </select >
                        </div>

                        <div class="form-group">
                          <label for="penyelenggara">Penyelenggara</label>
                          <select class="form-control"  id="penyelenggara" name="penyelenggara">
                            <option value="" disabled selected>Pilih Penyelenggara</option>
                            @foreach($penyelenggara as $sk)
                            <option value="{{$sk->id}}" {{ isset($pengajuan_serkom) && $pengajuan_serkom->penyelenggara->id == $sk->id ? 'selected' : '' }}>{{$sk->penyelenggara}}</option>
                            @endforeach
                          </select >
                        </div>

                        <div class="form-group">
                          <label for="jenis_sertifikasi">Tingkat Sertifikasi</label>
                          <select class="form-control"  id="jenis_sertifikasi" name="jenis_sertifikasi">
                            <option value="" disabled selected>Tingkat Sertifikasi</option>
                            @foreach($jenis_sertifikasi as $sk)
                            <option value="{{$sk->id}}" {{ isset($pengajuan_serkom) && $pengajuan_serkom->jenis_sertifikasi->id == $sk->id ? 'selected' : '' }}>{{$sk->jenis_sertifikasi}}</option>
                            @endforeach
                          </select >
                        </div>
                        
                        <div class="form-group">
                            <label for="tgl_pelaksanaan">Tanggal Pelaksanaan</label>
                            <input type="date" class="form-control" id="tgl_pelaksanaan" name="tgl_pelaksanaan" value="{{ isset($pengajuan_serkom) ? $pengajuan_serkom->tgl_pelaksanaan : '' }}" 
                            {{ Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan' ? 'readonly' : '' }} placeholder="Masukkan Tanggal Pelaksanaan">
                        </div>
                       
                        <div class="form-group">
                          <label for="anggaran">Anggaran Yang Diajukan</label>
                          <input type="text" class="form-control" id="anggaran" name="anggaran" 
                                 value="{{ isset($pengajuan_serkom) ? formatRupiah($pengajuan_serkom->pengajuan_serkom) : '' }}"  
                                 placeholder="Masukkan Angka Nominal Saja" onkeyup="this.value = formatRupiah(this.value)">
                      </div>

                        @if(auth()->user()->level=="Dekan" ||auth()->user()->level=="Admin Sekolah Vokasi" || auth()->user()->level=="Kaprodi" )
                        @isset($pengajuan_serkom)   
                        <div class="form-group">
                          <label for="status_pengajuanserkom">Status</label>
                          <select class="form-control"  id="status_pengajuanserkom" name="status_pengajuanserkom" >
                            <option value="{{ isset($pengajuan_serkom) ? $pengajuan_serkom->status_pengajuanserkom : '' }}">{{$pengajuan_serkom->status_pengajuanserkom}}    </option>
                            
                            @if($pengajuan_serkom->status_pengajuanserkom == "Belum Disetujui" && (auth()->user()->level=="Kaprodi" || auth()->user()->level=="Admin Sekolah Vokasi") )
                            <option value="Menunggu Validasi">Menunggu Validasi</option>
                            @elseif($pengajuan_serkom->status_pengajuanserkom == "Menunggu Validasi" && auth()->user()->level=="Dekan" )
                            <option value="Sudah Disetujui">Sudah Disetujui</option>
                            @else
                            <option value="Belum Disetujui">Belum Disetujui</option>
                            @endif
                          </select>
                        </div>
                        @endif
                        @else
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="status_pengajuanserkom" name="status_pengajuanserkom" value="Belum Disetujui">
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

        <script>
          function formatRupiah(angka) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }
        </script>
    </form>
@endsection