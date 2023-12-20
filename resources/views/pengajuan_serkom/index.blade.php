@extends('layouts.app')

@section('title', 'Data Pengajuan Serkom')

@section('contents')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Serkom</h6>
    </div>
    <div class="card-body">
        
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('pengajuan_serkom.tambah') }}" class="btn btn-primary mb-3">Tambah Pengajuan</a>
            @if(auth()->user()->level != "Tenaga Pendidik" && auth()->user()->level != "Tenaga Kependidikan")
                <a href="{{ route('pengajuan_serkom.export') }}" class="btn btn-success mb-3">Export ke Excel</a>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                    @if(auth()->user()->level!="Tenaga Pendidik" && auth()->user()->level!="Tenaga Kependidikan")
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Unit</th>
                    @endif
                        <th style="text-align: center;">Nama Sertifikasi</th>
                        <th style="text-align: center;">Periode</th>
                        <th style="text-align: center;">Skema</th>
                        <th style="text-align: center;">Penyelenggara</th>
                        <th style="text-align: center;">Tingkat Sertifikasi</th>
                        <th style="text-align: center;">Tgl Pelaksanaan</th>
                        
                        <th style="text-align: center;">Status</th>
                        
                        @if(auth()->user()->level=="Tenaga Pendidik" || auth()->user()->level=="Tenaga Kependidikan" || auth()->user()->level=="Dekan" || auth()->user()->level=="Admin Sekolah Vokasi" || auth()->user()->level=="Kaprodi")
                        <th style="text-align: center;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($no = 0)
                    @foreach ($data as $row)
                    <tr>
                        {{-- <th>{{ $no++ }}</th> --}}
                        <th>{{ $loop->iteration }}</th>
                    @if(auth()->user()->level!="Tenaga Pendidik" && auth()->user()->level!="Tenaga Kependidikan")
                        <td>{{ $row->user->nama }}</td>
                        <td>{{ $row->user->unit }}</td>
                    @endif
                        <td>{{ $row->nama_sertifikasi }}</td>
                        <td >{{ $row->periode->semester . ' ' . $row->periode->tahun }}</td>
                        <td>{{ $row->skema->nama_skema }}</td>
                        <td>{{ $row->penyelenggara->penyelenggara }}</td>
                        <td>{{ $row->jenis_sertifikasi->jenis_sertifikasi }}</td>
                        <td>{{ $row->tgl_pelaksanaan }}</td>
                        
                        @if ($row->status_pengajuanserkom=="Belum Disetujui")
                            <td ><span class="badge badge-danger btn-sm">{{ $row->status_pengajuanserkom }}</span></td>
                        @elseif($row->status_pengajuanserkom=="Menunggu Validasi")
                            <td ><span class="badge badge-warning btn-sm">{{ $row->status_pengajuanserkom }}</span></td>
                        @elseif($row->status_pengajuanserkom=="Pengajuan Ditolak")
                            <td ><span class="badge badge-danger btn-sm">{{ $row->status_pengajuanserkom }}</span></td>    
                        @else
                            <td ><span class="badge badge-success btn-sm">{{ $row->status_pengajuanserkom }}</span></td>
                        @endif

                        @if(auth()->user()->level=="Tenaga Pendidik" || auth()->user()->level=="Tenaga Kependidikan")                        

                        <td>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-outline-primary ml-1" href="{{ route('pengajuan_serkom.detail', $row->id) }}"> 
                                        <span><i class="ti-eye"></i></span>
                                    </a>
                                    <a class="btn btn-outline-warning ml-1" href="{{ route('pengajuan_serkom.edit', $row->id) }}"> 
                                        <span><i class="ti-pencil"></i></span>
                                    </a>
                                    
                                    <a class="btn btn-outline-danger ml-1" href="{{ route('pengajuan_serkom.hapus', $row->id) }}" onclick="return confirmDelete()"> 
                                        <span><i class="ti-trash"></i></span>
                                    </a>
                                    
                                    
                                </div>
                        </td> 
                        @elseif(auth()->user()->level=="Admin Sekolah Vokasi"||auth()->user()->level=="Kaprodi")
                        <td>
                            <div class="d-flex justify-content-between">

                                <a class="btn btn-outline-primary ml-1" href="{{ route('pengajuan_serkom.detail', $row->id) }}" > 
                                    <span><i class="ti-eye"></i></span>
                                </a>
                                @if($row->status_pengajuanserkom=="Belum Disetujui")
                                <button class="btn btn-sm btn-success ml-1 editBtn" data-id="{{ $row->id }}" data-statusawal="{{ $row->status_pengajuanserkom }}"> 
                                    <span><i class="ti-check"></i></span>
                                </button>
                                @endif
                            </div>
                        </td>
                        @elseif(auth()->user()->level=="Dekan")
                        <td>
                            <div class="d-flex justify-content-between">

                                <a class="btn btn-outline-primary ml-1" href="{{ route('pengajuan_serkom.detail', $row->id) }}" > 
                                    <span><i class="ti-eye"></i></span>
                                </a>
                                @if($row->status_pengajuanserkom=="Menunggu Validasi")
                                <button class="btn btn-sm btn-success ml-1 editBtn" data-id="{{ $row->id }}" data-statusawal="{{ $row->status_pengajuanserkom }}"> 
                                    <span><i class="ti-check"></i></span>
                                </button>
                                @endif
                            </div>
                        </td>                        
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="verifikasiModal" tabindex="-1" aria-labelledby="verifikasiModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifikasiModal">Verifikasi Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   
                </button>
            </div>
            <form id="verifikasiModal">
                @csrf
                <div class="modal-body">
                    <!-- Form inputs for psychiatrist's information -->
                    <input type="hidden" id="magangID" name="magangID">
                    <input type="hidden" id="statusAwalMod" name="statusAwalMod">
                    @if(auth()->user()->level=="Admin Sekolah Vokasi"||auth()->user()->level=="Kaprodi")
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="verifikasi" id="verifikasi" value="Menunggu Validasi">
                            <label class="form-check-label" for="male">Verifikasi</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="verifikasi" id="verifikasi" value="Pengajuan Ditolak">
                            <label class="form-check-label" for="female">Tolak</label>
                        </div>
                    </div>
                    @elseif(auth()->user()->level=="Dekan")
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="verifikasi" id="verifikasi" value="Pengajuan Disetujui">
                            <label class="form-check-label" for="male">Validasi</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="verifikasi" id="verifikasi" value="Pengajuan Ditolak">
                            <label class="form-check-label" for="female">Tolak</label>
                        </div>
                    </div>
                    @endif
                    <!-- Add more form inputs as needed -->
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateVerifikasi">Save</button>
                </div>
                </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript">
    
    $(document).on('click', '.editBtn', function() {
        var magangID = $(this).data('id');
        var statusAwalMod = $(this).data('statusawal');
        console.log(statusAwalMod + "test")
        $('#magangID').val(magangID);
        $('#statusAwalMod').val(statusAwalMod);
        $('#verifikasiModal').modal('show');
    });

    function confirmDelete() {
        return confirm("Apakah anda yakin?");
    }

    $('#updateVerifikasi').click(function() {
        
            var magangID = $('#magangID').val();
            var statusAwalMod = $('#statusAwalMod').val();

            var verifikasi = $('input[name="verifikasi"]:checked').attr('value');

            $.ajax({
                url: "{{ route('pengajuan_serkom.updateverif') }}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    statusAwal: statusAwalMod, 
                    id: magangID,
                    status: verifikasi,
                },
                success: function(response) {
                   location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                data: $('#verifikasiModal form').serialize(),
            });
        });

   




</script>
@endsection
