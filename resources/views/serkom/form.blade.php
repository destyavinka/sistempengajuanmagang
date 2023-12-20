@extends('layouts.app')

@section('title', 'Form Riwayat Serkom')

@section('contents')
    <form action="{{ isset($serkom) ? route('serkom.tambah.update', $serkom->id) : route('serkom.tambah.simpan') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($serkom) ? 'Form Edit Riwayat Serkom' : 'Form Tambah Riwayat Serkom' }}</h6>
                    </div>
                    <div class="card-body">

                      <input class="form-control mb-2" type="text" value="{{ $user->nama }} - {{ $user->unit }}" disabled style="font-weight: bold;">
                        
                        <div class="form-group">
                            <label for="nama_sertifikasi">Nama Sertifikasi</label>
                            <input type="text" class="form-control" id="nama_sertifikasi" name="nama_sertifikasi" value="{{ isset($serkom) ? $serkom->nama_sertifikasi : '' }}">
                        </div>

                          <div class="form-group">
                            <label for="skema">Skema</label>
                            <select class="form-control"  id="skema" name="skema">
                              <option value="" disabled selected>Pilih Skema</option>
                              @foreach($skema as $sk)
                              <option value="{{$sk->id}}" {{ isset($serkom) && $serkom->skema->id == $sk->id ? 'selected' : '' }}>{{$sk->nama_skema}}</option>
                              @endforeach
                            </select >
                          </div>

                          <div class="form-group">
                            <label for="penyelenggara">Penyelenggara</label>
                            <select class="form-control"  id="penyelenggara" name="penyelenggara">
                              <option value="" disabled selected>Pilih Penyelenggara</option>
                              @foreach($penyelenggara as $sk)
                              <option value="{{$sk->id}}" {{ isset($serkom) && $serkom->penyelenggara->id == $sk->id ? 'selected' : '' }}>{{$sk->penyelenggara}}</option>
                              @endforeach
                            </select >
                          </div>

                        <div class="form-group">
                            <label for="tgl_penerbitan">Tanggal Penerbitan</label>
                            <input type="date" class="form-control" id="tgl_penerbitan" name="tgl_penerbitan" value="{{ isset($serkom) ? $serkom->tgl_penerbitan : '' }}">
                        </div>
                        <div class="form-group">
                          <label for="masa_berlaku">Masa Berlaku</label>
                      
                          <div>
                              <label>
                                  <input type="checkbox" id="seumurHidup" name="seumur_hidup" {{ isset($serkom) && $serkom->status_seumur_hidup == 1 ? 'checked' : '' }}>
                                  Seumur Hidup
                              </label>
                          </div>
                      
                          <input type="date" class="form-control" id="masa_berlaku" name="masa_berlaku" value="{{ isset($serkom) ? $serkom->masa_berlaku : '' }}" >
                      </div>
                        <div class="form-group">
                            <label for="sertifikat">Sertifikat</label>
                            <input type="file" class="form-control" id="sertifikat" name="sertifikat" value="{{ isset($serkom) ? $serkom->sertifikat : '' }}">
                        </div>

                        @isset($serkom)   
                        <div class="form-group">
                          <label for="status_serkom">Status</label>
                          <select class="form-control"  id="status_serkom" name="status_serkom" >
                            <option value="{{ isset($serkom) ? $serkom->status_serkom : '' }}" disabled selected>{{$serkom->status_serkom}}    </option>
                            <option value="Belum Disetujui">Belum Disetujui</option>
                            <option value="Sudah Disetujui">Sudah Disetujui</option>
                          </select>
                        </div>
                        
                        @else
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="status_serkom" name="status_serkom" value="Belum Disetujui">
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