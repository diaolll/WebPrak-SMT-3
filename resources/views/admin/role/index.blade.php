<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $index => $item) 
        <tr>
            <td>{{ $index + 1}}</td> 
            <td>{{ $item->nama_role }}</td> 
        </tr>
        @endforeach
    </tbody>
</table>