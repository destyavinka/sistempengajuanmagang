    @extends('layouts.app')

    @section('title', 'Report Data')

    @section('contents')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Report Data</h6>
        </div>
        <div class="card-body">
            
        
            <div class="form-group">
                <label for="filter">Pilih Kategori</label>
                <select class="form-control" id="filter" name="filter">
                    <option value="all">All</option>
                    <option value="magang">Magang</option>
                    <option value="pekertian">Pekerti</option>
                    <option value="serkom">Serkom</option>
                </select>
            </div>

            <div class="form-group">
                <label for="unit">Filter by Unit:</label>
                <select class="form-control" id="unit" name="unit">
                    <option value="all">All</option>
                    @foreach ($unit as $filterunit)
                    <option value="{{ $filterunit->nama_unit }}">{{ $filterunit->nama_unit }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="masa_berlaku">Filter by Masa Berlaku:</label>
                <select class="form-control" id="masa_berlaku" name="masa_berlaku" onchange="toggleDateFilter()">
                    <option value="">All</option>
                    <option value="Seumur Hidup">Seumur Hidup</option>
                    <option value="Not Seumur Hidup">Pilih Jangka Waktu</option>
                </select>
            </div>
            
            <div class="form-group" id="dateFilter" style="display: none;">
                <label for="filter">Pilih Kategori</label>
                <select class="form-control" id="date" name="date">
                    <option value="3bulan">Kurang dari 3 bulan</option>
                    <option value="1tahun">Kurang dari 1 tahun</option>
                    <option value="2tahun">Kurang dari 2 tahun</option>
                </select>
            </div>
            
            <div class="form-group">
                <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-primary mt-2" onclick="applyFilter()">Filter</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#importReportDataModal" class="btn btn-warning mt-2" onclick="showImportReportDataModal()">Import File Excel</button>
                @php
                $currentUrl =  Request::fullUrl();
                $exportUrl = str_replace("reportdata", "reportdata/export-reportdata", $currentUrl);
                @endphp
                <a href="{{ $exportUrl  }}" class="btn btn-success mt-2">Export ke Excel</a>
                </div>
            </div>
            

            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="">No</th>
                            <th style="">Nama</th>
                            <th style="">Unit</th>
                            <th style="">Masa Berlaku</th>
                            <th style="">Status</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->unit }}</td>
                            @if($row->status_seumur_hidup == 1)
                                <td>Seumur Hidup</td>
                            @else
                                <td> {{ $row->masa_berlaku }}</td>  
                            @endif   
                            <td> {{ $row->status }}</td>        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>  
            <div class="modal fade" id="importReportDataModal" tabindex="-1" aria-labelledby="importReportDataModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifikasiModal">Import</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                               
                            </button>
                        </div>
                        <form id="formImportUser" action="{{ route('reportdata.importReportData') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <!-- Form inputs for psychiatrist's information -->
                                <input type="hidden" id="magangID" name="magangID">
                                <input type="hidden" id="statusAwalMod" name="statusAwalMod">
                                <input type="hidden" id="akun" name="akun" value="{{ auth()->user()->level }}">
                                
                                {{-- @elseif(auth()->user()->level=="Super Admin") --}}
                                <div class="form-group">
                                    <div class="form-group" id="fileshow">
                                        <label for="kategori">Kategori</label>
                                        <select class="form-control" id="kategori" name="kategori">
                                            <option value="1">Magang</option>
                                            <option value="2">Pekerti</option>
                                            <option value="3">Serkom</option>
                                        </select>
                                    </div>
                                </div>

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
    <script type="text/javascript">

    function toggleDateFilter() {
            const masaBerlakuValue = document.getElementById('masa_berlaku').value;
            const dateFilter = document.getElementById('dateFilter');
            dateFilter.style.display = masaBerlakuValue === 'Not Seumur Hidup' ? 'block' : 'none';
        }
        
        toggleDateFilter();

        // Listen for changes in the masa_berlaku dropdown and call the toggleDateFilter() function
        document.getElementById('masa_berlaku').addEventListener('change', toggleDateFilter);

        function applyFilter() {
            const filterValue = document.getElementById('filter').value;
            const unitValue = document.getElementById('unit').value;
            const masaBerlakuValue = document.getElementById('masa_berlaku').value;
            const dateFilterValue = document.getElementById('date').value;
            console.log(masaBerlakuValue);
            console.log(dateFilterValue);
            let queryString;
            if(masaBerlakuValue == "Seumur Hidup"){
                queryString = `?filter=${filterValue}&unit=${unitValue}&status=${masaBerlakuValue}&tgl=${dateFilterValue}`;
            }
            else{
                queryString = `?filter=${filterValue}&unit=${unitValue}&status=${masaBerlakuValue}&tgl=${dateFilterValue}`;

            }
            window.location.href = "{{ route('reportdata.index') }}" + queryString;
        }

    




    </script>

    @endsection


