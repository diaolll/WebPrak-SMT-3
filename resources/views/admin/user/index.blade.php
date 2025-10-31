{{-- resources/views/admin/user/index.blade.php --}}

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $index => $user)
        <tr>
            <td>{{ $index + 1}}</td> 
            <td>{{ $user->nama }}</td> 
            <td>{{ $user->email }}</td> 

        <td>
          @php
            $labels = $user->roles
              ->sortByDesc(fn($r) => (int) $r->pivot->status)   // Aktif duluan
              ->map(fn($r) => $r->nama_role.' ('.($r->pivot->status ? 'Aktif' : 'Nonaktif').')')
              ->implode(', ');
          @endphp

          {{ $labels !== '' ? $labels : '-' }}
        </td>
                    </tr>
        @endforeach
    </tbody>
</table>