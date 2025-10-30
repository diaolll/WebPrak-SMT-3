{{-- resources/views/admin/pet/index.blade.php --}}

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pet</th>
            <th>Tgl Lahir</th>
            <th>Warna Tanda</th>
            <th>Jenis Kelamin</th>
            <th>Ras Hewan</th>
            <th>Nama Pemilik</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pets as $index => $pet)
        <tr>
            <td>{{ $index + 1}}</td> 
            
            <td>{{ $pet->nama }}</td> 
            <td>{{ $pet->tanggal_lahir }}</td>
            <td>{{ $pet->warna_tanda }}</td>
            <td>{{ $pet->jenis_kelamin }}</td> 
            
            <td>{{ $pet->rasHewan->nama_ras }}</td>
            
            <td>{{ $pet->pemilik->user->nama }}</td> 

        </tr>
        @endforeach
    </tbody>
</table>