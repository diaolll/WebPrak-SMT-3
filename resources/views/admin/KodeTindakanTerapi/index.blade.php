{{-- resources/views/admin/kode-tindakan-terapi/index.blade.php --}}

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Deskripsi Tindakan Terapi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kodeTindakanTerapi as $index => $item)
        <tr>
            <td>{{ $index + 1}}</td> 
            <td>{{ $item->kode }}</td>
            <td>{{ $item->deskripsi_tindakan_terapi }}</td> 
        </tr>
        @endforeach
    </tbody>
</table>