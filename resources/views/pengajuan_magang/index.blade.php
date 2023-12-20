@extends('layouts.app')

@section('title', 'Data Pengajuan Magang')

@section('contents')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Add this before the closing </body> tag -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Magang</h6>
    </div>
    <div class="card-body">
        
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('pengajuan_magang.tambah') }}" class="btn btn-primary">Tambah Pengajuan</a>

            @if(auth()->user()->level != "Tenaga Pendidik" && auth()->user()->level != "Tenaga Kependidikan")
                <a href="{{ route('pengajuan_magang.export') }}" class="btn btn-success">Export ke Excel</a>
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
                        <th style="text-align: center;">Topik Magang</th>
                        <th style="text-align: center;">Periode</th>
                        <th style="text-align: center;">Skema</th>
                        <th style="text-align: center;">Instansi</th>
                        <th style="text-align: center;">Anggaran yang Diajukan</th>
                        <th style="text-align: center;">Anggaran yang Disetujui</th>

                        <th style="text-align: center;">Status</th>

                        @if(auth()->user()->level=="Tenaga Pendidik" || auth()->user()->level=="Tenaga Kependidikan" || auth()->user()->level=="Dekan" || auth()->user()->level=="Admin Sekolah Vokasi" || auth()->user()->level=="Kaprodi" || auth()->user()->level=="Super Admin")
                        <th style="text-align: center;">Aksi</th>
                        @endif
                        @if(auth()->user()->level=="Tenaga Pendidik" || auth()->user()->level=="Tenaga Kependidikan")
                        <th style="text-align: center;">Surat Tugas</th>
                        @endif

                     

                    </tr>
                </thead>
                <tbody>
                    @php($no = 0)
                    @foreach ($data as $row)
                    <?php $link = $row->surat_tugas; ?>
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        
                    @if(auth()->user()->level!="Tenaga Pendidik" && auth()->user()->level!="Tenaga Kependidikan")
                        <td style="text-align: center;">{{ $row->user->nama }}</td>
                        <td style="text-align: center;">{{ $row->user->unit }}</td>
                    @endif
                        <td style="text-align: center;">{{ $row->topik_magang }}</td>
                        <td style="text-align: center;">{{ $row->periode->semester . ' ' . $row->periode->tahun }}</td>
                        <td style="text-align: center;">{{ $row->skema->nama_skema }}</td>
                        <td style="text-align: center;">{{ $row->instansi->nama_instansi }}</td>
                        <td style="text-align: center;">{{ $row->pengajuan_anggaran }}</td>
                        <td style="text-align: center;">
                            @if($row->anggaran_disetujui != null)
                            {{ $row->anggaran_disetujui }}
                            @else
                            Belum Tersedia
                            @endif
                        </td>
                        @if ($row->status_pengajuanmagang=="Belum Disetujui")
                            <td style="text-align: center;" ><span class="badge badge-danger btn-sm">{{ $row->status_pengajuanmagang }}</span></td>
                        @elseif($row->status_pengajuanmagang=="Menunggu Validasi")
                            <td style="text-align: center;"><span class="badge badge-warning btn-sm">{{ $row->status_pengajuanmagang }}</span></td>
                        @elseif($row->status_pengajuanmagang=="Pengajuan Ditolak")
                            <td style="text-align: center;"><span class="badge badge-danger btn-sm">{{ $row->status_pengajuanmagang }}</span></td>    
                        @else
                            <td style="text-align: center;"><span class="badge badge-success btn-sm">{{ $row->status_pengajuanmagang }}</span></td>
                        @endif
                        
                        @if(auth()->user()->level=="Tenaga Pendidik" || auth()->user()->level=="Tenaga Kependidikan")                        

                        <td style="text-align: center;">
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-outline-primary ml-1" href="{{ route('pengajuan_magang.detail', $row->id) }}"> 
                                        <span><i class="ti-eye"></i></span>
                                    </a>
                                    <a class="btn btn-outline-warning ml-1" href="{{ route('pengajuan_magang.edit', $row->id) }}"> 
                                        <span><i class="ti-pencil"></i></span>
                                    </a>
                                    
                                    <a class="btn btn-outline-danger ml-1" href="{{ route('pengajuan_magang.hapus', $row->id) }}" onclick="return confirmDelete()"> 
                                        <span><i class="ti-trash"></i></span>
                                    </a>
                                    
                                    
                                </div>
                        </td> 
                        @elseif(auth()->user()->level=="Admin Sekolah Vokasi"||auth()->user()->level=="Kaprodi")
                        <td style="text-align: center;">
                            <div class="d-flex justify-content-between">

                                <a class="btn btn-outline-primary ml-1" href="{{ route('pengajuan_magang.detail', $row->id) }}" > 
                                    <span><i class="ti-eye"></i></span>
                                </a>
                                @if($row->status_pengajuanmagang=="Belum Disetujui")
                                <button class="btn btn-sm btn-success ml-1  editBtn" data-id="{{ $row->id }}" data-statusawal="{{ $row->status_pengajuanmagang }}"> 
                                    <span><i class="ti-check"></i></span>
                                </button>
                                @endif
                            </div>
                        </td>
                        @elseif(auth()->user()->level=="Dekan")  
                        <td style="text-align: center;">
                            <div class="d-flex justify-content-between">

                                <a class="btn btn-outline-primary ml-1" href="{{ route('pengajuan_magang.detail', $row->id) }}" > 
                                    <span><i class="ti-eye"></i></span>
                                </a>
                                @if($row->status_pengajuanmagang=="Menunggu Validasi")
                                <button class="btn btn-sm btn-success ml-1 editBtn" data-id="{{ $row->id }}" data-statusawal="{{ $row->status_pengajuanmagang }}"> 
                                    <span><i class="ti-check"></i></span>
                                </button>
                                @endif
                            </div>
                        </td>                        
                        @elseif(auth()->user()->level=="Super Admin")
                        <td style="text-align: center;">
                            <div class="d-flex justify-content-between">
                                @if($row->status_pengajuanmagang=="Pengajuan Disetujui")
                                <button class="btn btn-sm btn-primary editBtn" data-id="{{ $row->id }}" data-statusawal="{{ $row->status_pengajuanmagang }}"> 
                                    <span><i class="ti-upload"></i></span>
                                </button>
                                @endif
                            </div>
                        </td>
                        @endif
                        @if(auth()->user()->level=="Tenaga Pendidik" || auth()->user()->level=="Tenaga Kependidikan")
                        <td style="text-align: center;">
                            @if($row->status_pengajuanmagang=="Pengajuan Disetujui")
                            <a href="{{ asset('surat_tugas/'.$link) }}" download class="btn btn-primary btn-sm">
                                Download File
                            </a>
                            @else
                            Belum Tersedia
                            @endif
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
                    <input type="hidden" id="akun" name="akun" value="{{ auth()->user()->level }}">
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
                        <div class="form-group" id="verifikasiInput" style="display: none;">
                            <label for="verifikasiInputField">Additional Input Field:</label>
                            <input type="text" class="form-control" id="verifikasiInputField" name="verifikasiInputField">
                        </div>
                        <div class="form-group" id="fileshow" style="display: none;">>
                            <label for="file">Surat Tugas</label>
                            <input type="file" class="form-control" id="file" name="file">
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
                        <div class="form-group" id="anggaran" style="display: none;">
                            <label for="anggaransetuju">Anggaran yang Disetujui:</label>
                            <input type="text" class="form-control" id="anggaransetuju" name="anggaransetuju" onkeyup="this.value = formatRupiah(this.value)">
                        </div>
                    </div>
                    @elseif(auth()->user()->level=="Super Admin")
                    <div class="form-group">
                        <div class="form-group" id="fileshow">
                            <label for="file">Surat Tugas</label>
                            <input type="file" class="form-control" id="file" name="file">
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

    var akun = $('#akun').val();
    if(akun == 'Dekan'){
        $("input[name='verifikasi']").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue === 'Pengajuan Disetujui') {
                $("#anggaran").show();
                $("#fileshow").show();
            } else {
                $("#anggaran").hide();
                $("#fileshow").hide();
            }
        });
    }

    function confirmDelete() {
        return confirm("Apakah anda yakin?");
    }

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

    $('#updateVerifikasi').click(function() {
        
            var magangID = $('#magangID').val();
            var statusAwalMod = $('#statusAwalMod').val();
            var anggaransetuju = $('#anggaransetuju').val();
            var fileInput = $('#file')[0]?.files[0];
            // console.log(fileInput);


            var verifikasi = $('input[name="verifikasi"]:checked').attr('value');

            var formData = new FormData();
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                formData.append('statusAwal', statusAwalMod);
                formData.append('id', magangID);
                formData.append('status', verifikasi);
                formData.append('anggaransetuju', anggaransetuju);
                formData.append('fileInput', fileInput);

            $.ajax({
                url: "{{ route('pengajuan_magang.updateverif') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false, 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response)
                    alert('Pengajuan Magang updated successfully!');
                   location.reload();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                // Handle validation errors
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';
                        for (var field in errors) {
                            errorMessage += errors[field][0] + '\n';
                        }
                    alert(errorMessage);
                    } else {
                        alert('An error occurred. Please try again later.');
                    }
                        },
            });
        });

   




</script>
@endsection


