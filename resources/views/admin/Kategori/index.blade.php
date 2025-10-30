
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategori as $index => $item)
        <tr>
            <td>{{ $index + 1}}</td> 
            <td>{{ $item->nama_kategori }}</td> 
        </tr>
        @endforeach
    </tbody>
</table>