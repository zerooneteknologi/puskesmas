<thead>
    <tr>
        <th>
            No
        </th>
        <th>Nama</th>
        <th>Nomor</th>
        <th>Potongan (Rp)</th>
        <th>Jumlah (Rp)</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach ($pasiens as $pasien)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $pasien->pasien_name }}</td>
        <td>{{ $pasien->pasien_nomor }}</td>
        <td style="text-align: right">{{ number_format($pasien->pasien_discount, 0, ",", ".") }}</td>

        @php
        $price = $pasien->notes->sum('note_price') - $pasien->pasien_discount;
        @endphp
        <td style="text-align: right">{{ number_format($price, 0, ",", ".") }}</td>
        <td>
            <a href="{{ route('pasien.show', $pasien->id)}}" target="_blank" data-bs-toggle="tooltip"
                data-bs-placement="top" title="rincian" class="badge bg-primary border-0"><i
                    class="bi bi-printer me-1"></i></a>
            @if (auth()->user()->role_id == 1)
            <form action="{{ route('pasien.destroy', $pasien->id)}}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="badge bg-danger border-0"
                    onclick="return confirm('Yakin ingin menghapus data ini?')" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="hapus"><i class="bi bi-trash3 me-1"></i></button>
            </form>
            @endif

        </td>
    </tr>
    @endforeach
</tbody>