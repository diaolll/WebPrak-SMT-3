{{-- resources/views/admin/kategori-klinis/index.blade.php --}}

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori Klinis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategoriKlinis as $index => $item)
        <tr>
            <td>{{ $index + 1}}</td> 
            <td>{{ $item->nama_kategori_klinis }}</td> 
        </tr>
        @endforeach
    </tbody>
</table>