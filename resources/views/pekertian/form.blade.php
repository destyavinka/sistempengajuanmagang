@extends('layouts.app')

@section('title', 'Form Pekerti')

@section('contents')
    <form action="{{ isset($pekerti) ? route('pekertian.tambah.update', $pekerti->id) : route('pekertian.tambah.simpan') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($pekerti) ? 'Form Edit Pekerti' : 'Form Tambah Pekerti' }}</h6>
                    </div>
                    <div class="card-body">

                        <input class="form-control mb-2" type="text" value="{{ $user->nama }} - {{ $user->unit }}" disabled style="font-weight: bold;">
                        
                        <div class="form-group">
                            <label for="nomor_sertifikat">Nomor Sertifikat</label>
                            <input type="text" class="form-control" id="nomor_sertifikat" name="nomor_sertifikat" value="{{ isset($pekerti) ? $pekerti->nomor_sertifikat : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_pelaksanaan">Tanggal Pelaksanaan</label>
                            <input type="date" class="form-control" id="tgl_pelaksanaan" name="tgl_pelaksanaan" value="{{ isset($pekerti) ? $pekerti->tgl_pelaksanaan : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="sertifikat">Sertifikat</label>
                            <input type="file" class="form-control" id="sertifikat" name="sertifikat" value="{{ isset($pekerti) ? $pekerti->sertifikat : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_penerbitan">Tanggal Penerbitan</label>
                            <input type="date" class="form-control" id="tgl_penerbitan" name="tgl_penerbitan" value="{{ isset($pekerti) ? $pekerti->tgl_penerbitan : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="masa_berlaku">Masa Berlaku</label>
                        
                            <div>
                                <label>
                                    <input type="checkbox" id="seumurHidup" name="seumur_hidup" {{ isset($pekerti) && $pekerti->status_seumur_hidup == 1 ? 'checked' : '' }}>
                                    Seumur Hidup
                                </label>
                            </div>
                        
                            <input type="date" class="form-control" id="masa_berlaku" name="masa_berlaku" value="{{ isset($pekeri) ? $pekeri->masa_berlaku : '' }}" 
                            {{ (isset($pekerti) && $pekerti->status_seumur_hidup == 1) || (Auth::user()->level != 'Tenaga Pendidik' && Auth::user()->level != 'Tenaga Kependidikan') ? 'readonly' : '' }}>
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