@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">@include('flash-massage')</div>
            </div>
            <div class="row">
                <div class="col-12  mb-4 mb-xl-0">
                    <h2 class="font-weight-bold">Selamat datang, {{ auth()->user()->nama }}</h2>
                </div>

            </div>




        </div>
    </div>
    
    {{-- <div class="row">
      <div class="col-xl-3 col-sm-6 col-12"> 
        <div class="card bg-danger mb-2 text-white">
          <div class="card-content">
            <div class="card-body color-info">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3>{{$dataOfCount['dataCountPengajuanMagangBelumDiSetujui']}}</h3>
                  <span>Pengajuan Magang Belum Di Setujui</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12"> 
        <div class="card bg-warning mb-2 text-white">
          <div class="card-content">
            <div class="card-body color-info">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3>{{$dataOfCount['dataCountPengajuanMagangBelumDiValidasi']}}</h3>
                  <span>Pengajuan Magang Menunggu Validasi</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12"> 
        <div class="card bg-success mb-2 text-white">
          <div class="card-content">
            <div class="card-body color-info">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3>{{$dataOfCount['dataCountPengajuanMagangSudahDiSetujui']}}</h3>
                  <span>Pengajuan Magang Sudah Disetujui</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}

    <br>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card tale-bg">
                <div class="card-people mt-auto">
                    <img src="{{ asset('img/simaskot_oren.png') }}" alt="people">
                </div>
            </div>
        </div>
    </div>


@endsection
