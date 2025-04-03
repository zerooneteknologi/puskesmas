@include('partials.meta')

<!-- Table with stripped rows -->
<table class="table datatable table-hover" id="pasienTable">
    <thead>
        <tr>
            <th>
                No
            </th>
            <th>Nama</th>
            <th>Nomor</th>
            <th>Potongan (%)</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pasiens as $pasien)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pasien->pasien_name }}</td>
            <td>{{ $pasien->pasien_nomor }}</td>
            <td>{{ $pasien->pasien_discount }}</td>

            @php
            $price = $pasien->notes->sum('note_price') - ($pasien->notes->sum('note_price') *
            $pasien->pasien_discount /100);
            @endphp
            <td>Rp. {{ number_format($price, 2, ",",".") }}</td>
            <td>
                <a href="{{ route('pasien.show', $pasien->id)}}" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="rincian" class="badge bg-primary border-0"><i class="bi bi-printer me-1"></i></a>
                <button type="button"
                    onclick="discount({{ $pasien->id }}, '{{ $pasien->pasien_nomor}}', '{{$pasien->pasien_name}}', '{{ $pasien->pasien_age}}', '{{ $pasien->pasien_address}}', '{{ $pasien->pasien_status}}', '{{$pasien->pasien_in}}', '{{$pasien->pasien_out}}', '{{$pasien->pasien_sum}}', '{{$pasien->pasien_room}}', '{{$pasien->pasien_diagnoses}}', '{{ $pasien->pasien_discount}}')"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="edit" class="badge bg-warning border-0"><i
                        class="bi bi-pencil-square me-1"></i></button>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- End Table with stripped rows -->

@include('partials.footer')
<script>
    $(document).ready(function() {
        $('#pasienTable').DataTable({
            ordering: false,
            info: false,
            paging: false,
            searching: false,
            dom: 'Bfrtip', // Menambahkan tombol ekspor
            buttons: [
            'excel', 'pdf', 'print' // Pilihan ekspor
            ],
        });
    });
</script>