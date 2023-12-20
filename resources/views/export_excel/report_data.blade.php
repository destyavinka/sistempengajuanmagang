<table>
    <thead>
    <tr>
        <th style="width:100%; text-align:center;">No</th>
                            <th style="width:300%; text-align:center;">Nama</th>
                            <th style="width:300%; text-align:center;">Unit</th>
                            <th style="width:300%; text-align:center;">Masa Berlaku</th>
                            <th style="width:300%; text-align:center;">Status</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <th style="text-align:center;">{{ $loop->iteration }}</th>
            <td style="text-align:left;">{{ $row->nama }}</td>
            <td style="text-align:left;">{{ $row->unit }}</td>
            @if($row->status_seumur_hidup == 1)
                <td style="text-align:left;">Seumur Hidup</td>
            @else
                <td style="text-align:left;"> {{ $row->masa_berlaku }}</td>  
            @endif   
            <td style="text-align:left;"> {{ $row->status }}</td>        
        </tr>
        @endforeach
    </tbody>
</table>