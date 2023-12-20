@extends('layouts.app')

@section('title', 'Form Pengajuan Magang')

@section('contents')
   
    <form action="{{ isset($pengajuan_magang) ? route('pengajuan_magang.tambah.update', $pengajuan_magang->id) : route('pengajuan_magang.tambah.simpan') }}" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" id="topik_magang" name="topik_magang" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->topik_magang : '' }}" 
                            {{ Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan' ? 'readonly' : '' }} placeholder="Masukkan Topik Magang">
                            {{-- //cek apabila user yang login memiliki level bukan tendik & bukan tenaga kependidikan maka dia readonly --}}
                          </div>

                          <label for="periode">Periode</label>
                          <select class="form-control" id="periode" name="periode" style="margin-bottom: 20px;" >
                            <option value="" disabled selected>Pilih Periode</option>
                            @foreach ($periode as $periode)
                                <option value="{{ $periode->id }}" {{ isset($pengajuan_magang) && $pengajuan_magang->periode_id == $periode->id ? 'selected' : '' }}>
                                    {{ $periode->semester . ' ' . $periode->tahun }}
                                </option>
                            @endforeach
                        </select>
                        
                        <div class="form-group" >
                          <label for="skema">Skema</label>
                          <select class="form-control"  id="skema" name="skema" >
                            <option value="" disabled selected>Pilih Skema</option>
                            @foreach($skema as $sk)
                            <option value="{{$sk->id}}" {{ isset($pengajuan_magang) && $pengajuan_magang->skema->id == $sk->id ? 'selected' : '' }}>{{$sk->nama_skema}}</option>
                            @endforeach
                          </select >
                        </div>
                        
                        <div class="form-group">
                            <label for="instansi">Instansi Magang</label>
                            <select class="form-control" id="instansi" name="instansi" >
                              <option value="" disabled selected>Pilih Instansi Magang</option>
                              @foreach($instansi as $sk)
                              <option value="{{$sk->id}}" {{ isset($pengajuan_magang) && $pengajuan_magang->instansi->id == $sk->id ? 'selected' : '' }}>{{$sk->nama_instansi}}</option>
                              @endforeach
                            </select>
                          </div>                          
                        
                        
                        <div class="form-group">
                            <label for="tgl_daftar">Tanggal Daftar</label>
                            <input type="date" class="form-control" id="tgl_daftar" name="tgl_daftar" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->tgl_daftar : '' }}"
                            {{ Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan' ? 'readonly' : '' }}>
                        </div>
                        
                        <div class="form-group">
                            <label for="tgl_pelaksanaan">Tanggal Pelaksanaan</label>
                            <input type="date" class="form-control" id="tgl_pelaksanaan" name="tgl_pelaksanaan" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->tgl_pelaksanaan : '' }}"
                            {{ Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan' ? 'readonly' : '' }}>
                        </div>
                 
                        <div class="form-group">
                            <label for="pengajuan_anggaran">Anggaran Yang Diajukan</label>
                            <input type="text" class="form-control" id="pengajuan_anggaran" name="pengajuan_anggaran" 
                                   value="{{ isset($pengajuan_magang) ? formatRupiah($pengajuan_magang->pengajuan_anggaran) : '' }}"  
                                   placeholder="Masukkan Angka Nominal Saja" onkeyup="this.value = formatRupiah(this.value)">
                        </div>
                        

                        <div class="form-group">
                            <label for="keterangan_anggaran">Keterangan Keperluan Anggaran</label>
                            <textarea class="form-control" id="keterangan_anggaran" name="keterangan_anggaran" rows="4" cols="50" 
                              {{ Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan' ? 'readonly' : '' }}
                              placeholder="Sebutkan Keperluan Anggaran yang Akan Digunakan">{{ isset($pengajuan_magang) ? $pengajuan_magang->keterangan_anggaran : '' }}</textarea>
                          </div>
                          
                          <div class="form-group">
                            <label for="dokumen_dukung">Dokumen Dukung</label>
                            <input type="file" class="form-control" id="dokumen_dukung" name="dokumen_dukung" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->dokumen_dukung : '' }}" 
                            {{ Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan' ? 'readonly' : '' }} placeholder="Masukkan Dokumen Dukung">
                            {{-- //cek apabila user yang login memiliki level bukan tendik & bukan tenaga kependidikan maka dia readonly --}}
                            <small class="text-muted">*Apabila dokumen lebih dari 1, mohon untuk di combine terlebih dahulu.</small>
                        </div>

                      
                      @if(auth()->user()->level=="Dekan")
                        @isset($pengajuan_magang) 
                            <div class="form-group">
                                <label for="anggaran_disetujui">Anggaran Yang Disetujui</label>
                                <input type="int" class="form-control" id="anggaran_disetujui" name="anggaran_disetujui" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->anggaran_disetujui : '' }}">
                            </div>
                        @endif
                    @endif

                    @if(auth()->user()->level=="Dekan")
                        @isset($pengajuan_magang) 
                            <div class="form-group">
                                <label for="surat_tugas">Surat Tugas</label>
                                <input type="file" class="form-control" id="surat_tugas" name="surat_tugas" value="{{ isset($pengajuan_magang) ? $pengajuan_magang->surat_tugas : '' }}">
                            </div>
                        @endif
                    @endif



                      
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
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Fungsi untuk mendapatkan tanggal hari ini
            function getCurrentDate() {
                var today = new Date();
                var day = String(today.getDate()).padStart(2, '0');
                var month = String(today.getMonth() + 1).padStart(2, '0');
                var year = today.getFullYear();
                return year + '-' + month + '-' + day;
            }
        
            // Memasukkan tanggal hari ini ke input tanggal daftar
            document.addEventListener('DOMContentLoaded', function() {
                var tglDaftarInput = document.getElementById('tgl_daftar');
                if (tglDaftarInput) {
                    tglDaftarInput.value = getCurrentDate();
                }
            });

            // Function untuk mengubah angka menjadi format nominal rupiah dengan pemisah ribuan titik
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