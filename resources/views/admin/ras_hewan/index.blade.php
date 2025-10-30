<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Ras Hewan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rashewan as $index => $ras)
        <tr>
            <td>{{ $index + 1}}</td> 
            <td>{{ $ras->nama_ras }}</td>
        </tr>
        @endforeach
    </tbody>
</table>