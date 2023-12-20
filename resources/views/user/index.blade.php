@extends('layouts.app')

@section('title', 'Data User')

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('user.tambah') }}" class="btn btn-primary mb-3">Tambah User</a>
        <button class="btn btn-success mb-3 importUserModalBtn">Import File Excel</button>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Email</th>
                        <th>Unit</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 0)
                    @foreach ($data as $row)
                    <tr>
                        {{-- <th>{{ $no++ }}</th> --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->nip }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->unit }}</td>
                        <td>{{ $row->level }}</td> 
                        {{-- <td>{{ $row->unit->nama_unit }}</td>
                        <td>{{ $row->role->role }}</td> --}}
                        <td>
                            <a href="{{ route('user.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('user.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
                        </td>              
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="importUserModal" tabindex="-1" aria-labelledby="importUserModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verifikasiModal">Import</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           
                        </button>
                    </div>
                    <form id="formImportUser" action="{{ route('user.importUser') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <!-- Form inputs for psychiatrist's information -->
                            <input type="hidden" id="magangID" name="magangID">
                            <input type="hidden" id="statusAwalMod" name="statusAwalMod">
                            <input type="hidden" id="akun" name="akun" value="{{ auth()->user()->level }}">
                            
                            {{-- @elseif(auth()->user()->level=="Super Admin") --}}
                            <div class="form-group">
                                <div class="form-group" id="fileshow">
                                    <label for="file">Import File Excel</label>
                                    <input type="file" class="form-control" id="file" name="file">
                                </div>
                            </div>
                            {{-- @endif --}}
                            <!-- Add more form inputs as needed -->
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="importUserSubmitBtn">Save</button>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    $(document).on('click', '.importUserModalBtn', function() {
        // var magangID = $(this).data('id');
        // var statusAwalMod = $(this).data('statusawal');
        // console.log(statusAwalMod + "test")
        // $('#magangID').val(magangID);
        // $('#statusAwalMod').val(statusAwalMod);
        $('#importUserModal').modal('show');

    });

    // $(document).on('click', '#importUserSubmitBtn', function() {
    //          var fileInput = $('#file')[0]?.files[0];
    //          console.log(fileInput);
    //          return;

    //          var formData = new FormData();
    //             formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    //             formData.append('fileInput', fileInput);

    //         $.ajax({
    //             url: "{{ route('user.importUser') }}",
    //             type: 'POST',
    //             data: formData,
    //             processData: false,
    //             contentType: false, 
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             success: function(response) {
    //                 console.log(response)
    //                 alert('Pengajuan Magang updated successfully!');
    //                location.reload();
    //             },
    //             error: function(xhr) {
    //                 if (xhr.status === 422) {
    //             // Handle validation errors
    //                     var errors = xhr.responseJSON.errors;
    //                     var errorMessage = '';
    //                     for (var field in errors) {
    //                         errorMessage += errors[field][0] + '\n';
    //                     }
    //                 alert(errorMessage);
    //                 } else {
    //                     alert('An error occurred. Please try again later.');
    //                 }
    //                     },
    //         });

    // });
</script>
@endsection
