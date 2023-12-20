@extends('layouts.app')

@section('title', 'Form Riwayat Magang')

@section('contents')
    <form action="{{ isset($magang) ? route('magang.tambah.update', $magang->id) : route('magang.tambah.simpan') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($magang) ? 'Form Edit Riwayat Magang' : 'Form Tambah Riwayat Magang' }}</h6>
                    </div>
                    <div class="card-body">
                        
                        <input class="form-control mb-2" type="text" value="{{ $user->nama }} - {{ $user->unit }}" disabled style="font-weight: bold;">
                            
                        <div class="form-group">
                            <label for="topik_magang"><br>Topik Magang</label>
                            <input type="text" class="form-control" id="topik_magang" name="topik_magang" value="{{ isset($magang) ? $magang->topik_magang : '' }}" 
                            {{ Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan' ? 'readonly' : '' }} placeholder="Masukkan Topik Magang">
                            {{-- //cek apabila user yang login memiliki level bukan tendik & bukan tenaga kependidikan maka dia readonly --}}
                        </div>

                        <label for="periode">Periode</label>
                          <select class="form-control" id="periode" name="periode" style="margin-bottom: 20px;">
                            <option value="" disabled selected>Pilih Periode</option>
                            @foreach ($periode as $periode)
                                <option value="{{ $periode->id }}" {{ isset($magang) && $magang->periode_id == $periode->id ? 'selected' : '' }}>
                                    {{ $periode->semester . ' ' . $periode->tahun }}
                                </option>
                            @endforeach
                        </select>

                        <div class="form-group">
                          <label for="skema">Skema</label>
                          <select class="form-control"  id="skema" name="skema">
                            <option value="" disabled selected>Pilih Skema</option>
                            @foreach($skema as $sk)
                            <option value="{{$sk->id}}" {{ isset($magang) && $magang->skema->id == $sk->id ? 'selected' : '' }}>{{$sk->nama_skema}}</option>
                            @endforeach
                          </select >
                        </div>

                        <div class="form-group">
                          <label for="instansi">Instansi</label>
                          <select class="form-control"  id="instansi" name="instansi">
                            <option value="" disabled selected>Pilih Instansi</option>
                            @foreach($instansi as $sk)
                            <option value="{{$sk->id}}" {{ isset($magang) && $magang->instansi->id == $sk->id ? 'selected' : '' }}>{{$sk->nama_instansi}}</option>
                            @endforeach
                          </select >
                        </div>

                        <div class="form-group">
                            <label for="tgl_daftar">Tanggal Daftar</label>
                            <input type="date" class="form-control" id="tgl_daftar" name="tgl_daftar" value="{{ isset($magang) ? $magang->tgl_daftar : '' }}"
                            {{ Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan' ? 'readonly' : '' }}>
                        </div>

                        <div class="form-group">
                            <label for="tgl_pelaksanaan">Tanggal Pelaksanaan</label>
                            <input type="date" class="form-control" id="tgl_pelaksanaan" name="tgl_pelaksanaan" value="{{ isset($magang) ? $magang->tgl_pelaksanaan : '' }}"
                            {{ Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan' ? 'readonly' : '' }}>
                        </div>

                        <div class="form-group">
                            <label for="sertifikat">Sertifikat Magang</label>
                            <input type="file" class="form-control" id="sertifikat" name="sertifikat" value="{{ isset($magang) ? $magang->sertifikat : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="tgl_penerbitan">Tanggal Penerbitan</label>
                            <input type="date" class="form-control" id="tgl_penerbitan" name="tgl_penerbitan" value="{{ isset($magang) ? $magang->tgl_penerbitan : '' }}"
                            {{ Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan' ? 'readonly' : '' }}>
                        </div>

                        {{-- <div class="form-group">
                            <label for="masa_berlaku">Masa Berlaku</label>
                            <input type="date" class="form-control" id="masa_berlaku" name="masa_berlaku" value="{{ isset($magang) ? $magang->masa_berlaku : '' }}"
                            {{ Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan' ? 'readonly' : '' }}>
                        </div> --}}
                        <div class="form-group">
                            <label for="masa_berlaku">Masa Berlaku</label>
                        
                            <div>
                                <label>
                                    <input type="checkbox" id="seumurHidup" name="seumur_hidup" {{ isset($magang) && $magang->status_seumur_hidup == 1 ? 'checked' : '' }}>
                                    Seumur Hidup
                                </label>
                            </div>
                        
                            <input type="date" class="form-control" id="masa_berlaku" name="masa_berlaku" value="{{ isset($magang) ? $magang->masa_berlaku : '' }}" 
                            {{ (isset($magang) && $magang->status_seumur_hidup == 1) || (Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan') ? 'readonly' : '' }}>
                        </div>
                       

                        @if(auth()->user()->level=="Dekan" ||auth()->user()->level=="Admin Sekolah Vokasi" || auth()->user()->level=="Kaprodi" )
                        @isset($magang)   
                        <div class="form-group">
                          <label for="status_magang">Status</label>
                          <select class="form-control"  id="status_magang" name="status_magang" >
                            <option value="{{ isset($magang) ? $magang->status_magang : '' }}">{{$magang->status_magang}}    </option>
                            
                            @if($magang->status_magang == "Belum Disetujui" && (auth()->user()->level=="Kaprodi" || auth()->user()->level=="Admin Sekolah Vokasi") )
                            <option value="Menunggu Validasi">Menunggu Validasi</option>
                            @elseif($magang->status_magang == "Menunggu Validasi" && auth()->user()->level=="Dekan" )
                            <option value="Sudah Disetujui">Sudah Disetujui</option>
                            @else
                            <option value="Belum Disetujui">Belum Disetujui</option>
                            @endif
                          </select>
                        </div>
                        @endif
                        @else
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="status_magang" name="status_magang" value="Belum Disetujui">
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

            document.addEventListener('DOMContentLoaded', function() {
                var masaBerlakuInput = document.getElementById('masa_berlaku');
                var seumurHidupCheckbox = document.getElementById('seumurHidup');

                function toggleMasaBerlaku() {
                    masaBerlakuInput.disabled = seumurHidupCheckbox.checked;
                }

                // Call the function on page load to set the initial state based on checkbox status
                toggleMasaBerlaku();

                // Add an event listener to the checkbox to call the function whenever the checkbox state changes
                seumurHidupCheckbox.addEventListener('change', function() {
                    toggleMasaBerlaku();

                    // Set the value of the 'status_seumur_hidup' input to 1 if the checkbox is checked
                    document.getElementById('status_seumur_hidup').value = seumurHidupCheckbox.checked ? 1 : 0;
                });
            });
        </script>
    </form>
@endsection