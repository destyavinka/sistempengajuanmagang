<table>
    <thead>
        <tr>
            <th>No</th>
            @if (auth()->user()->level != 'Tenaga Pendidik' && auth()->user()->level != 'Tenaga Kependidikan')
                <th>Nama</th>
                <th>Unit</th>
            @endif
            <th>Topik Magang</th>
            <th>Periode</th>
            <th>Skema</th>
            <th>Instansi</th>
            <th>Status</th>

            @if (auth()->user()->level == 'Tenaga Pendidik' ||
                    auth()->user()->level == 'Tenaga Kependidikan' ||
                    auth()->user()->level == 'Dekan' ||
                    auth()->user()->level == 'Admin Sekolah Vokasi' ||
                    auth()->user()->level == 'Kaprodi')
                <th>Aksi</th>
            @endif

            @if (auth()->user()->level == 'Tenaga Pendidik' || auth()->user()->level == 'Tenaga Kependidikan')
                <th>Surat Tugas</th>
            @endif

        </tr>
    </thead>
    <tbody>
        @php($no = 0)
        @foreach ($data as $row)
            <tr>
                <th>{{ $loop->iteration }}</th>

                @if (auth()->user()->level != 'Tenaga Pendidik' && auth()->user()->level != 'Tenaga Kependidikan')
                    <td>{{ $row->user->nama }}</td>
                    <td>{{ $row->user->unit }}</td>
                @endif
                <td>{{ $row->topik_magang }}</td>
                <td>{{ $row->periode->semester . ' ' . $row->periode->tahun }}</td>
                <td>{{ $row->skema->nama_skema }}</td>
                <td>{{ $row->instansi->nama_instansi }}</td>

                @if ($row->status_pengajuanmagang == 'Belum Disetujui')
                    <td><span class="badge badge-danger btn-sm">{{ $row->status_pengajuanmagang }}</span></td>
                @elseif($row->status_pengajuanmagang == 'Menunggu Validasi')
                    <td><span class="badge badge-warning btn-sm">{{ $row->status_pengajuanmagang }}</span></td>
                @else
                    <td><span class="badge badge-success btn-sm">{{ $row->status_pengajuanmagang }}</span></td>
                @endif

                @if (auth()->user()->level == 'Tenaga Pendidik' ||
                        auth()->user()->level == 'Tenaga Kependidikan' ||
                        auth()->user()->level == 'Dekan' ||
                        auth()->user()->level == 'Admin Sekolah Vokasi' ||
                        auth()->user()->level == 'Kaprodi')
                    <td>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-outline-primary ml-1"
                                href="{{ route('pengajuan_magang.detail', $row->id) }}">
                                <span><i class="ti-eye"></i></span>
                            </a>
                            <a class="btn btn-outline-warning ml-1"
                                href="{{ route('pengajuan_magang.edit', $row->id) }}">
                                <span><i class="ti-pencil"></i></span>
                            </a>

                            <a class="btn btn-outline-danger ml-1"
                                href="{{ route('pengajuan_magang.hapus', $row->id) }}"
                                onclick="return confirmDelete()">
                                <span><i class="ti-trash"></i></span>
                            </a>


                        </div>
                    </td>
                @endif

                @if (auth()->user()->level == 'Tenaga Pendidik' || auth()->user()->level == 'Tenaga Kependidikan')
                    <td>
                        <div class="d-flex justify-content-between">
                            @if ($row->status_pengajuanmagang == 'Sudah Disetujui')
                                <a class="btn btn-outline-success" href="{{ asset('surat_tugas/' . $row->surat_tugas) }}"
                                    download>
                                    <span
                                        style="display: block; line-height: 1.2; max-height: 3.6em; overflow: hidden; text-overflow: ellipsis; width: 100%;">
                                        <i class="ti-file"></i>Surat Tugas
                                    </span>
                                </a>
                            @else
                                <span
                                    style="display: block; line-height: 1.2; max-height: 3.6em; overflow: hidden; text-overflow: ellipsis; width: 100%;">
                                    Belum Tersedia
                                </span>
                            @endif
                        </div>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
