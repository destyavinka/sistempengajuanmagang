<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Sertifikasi</th>
            <th>Tanggal Pelaksanaan</th>
            <th>Anggaran</th>
            <th>Status Pengajuan Serkom</th>
            <th>Skema</th>
            <th>Penyelenggara</th>
            <th>Periode</th>
            <th>Jenis Sertifikasi</th>



        </tr>
    </thead>
    <tbody>
        @php($no = 0)
        @foreach ($data as $row)
            <tr>
                <th>{{ $loop->iteration }}</th>

                <td>{{ $row->nama_sertifikasi }}</td>
                <td>{{ $row->tgl_pelaksanaan }}</td>
                <td>{{ $row->anggaran }}</td>
                <td>{{ $row->status_pengajuanserkom }}</td>
                <td>{{ $row->skema->nama_skema }}</td>
                <td>{{ $row->penyelenggara->penyelenggara }}</td>
                <td>{{ $row->periode->tahun . '/' . $row->periode->semester }}</td>
                <td>{{ $row->jenis_sertifikasi->jenis_sertifikasi }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
