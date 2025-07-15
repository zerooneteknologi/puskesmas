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
                <a href="{{ route('pasien.show', $pasien->id)}}" target="_blank" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="rincian" class="badge bg-primary border-0"><i
                        class="bi bi-printer me-1"></i></a>
                @if (auth()->user()->role_id == 1)
                <button type="button"
                    onclick="discount({{ $pasien->id }}, '{{ $pasien->pasien_nomor}}', '{{$pasien->pasien_name}}', '{{ $pasien->pasien_age}}', '{{ $pasien->pasien_address}}', '{{ $pasien->pasien_status}}', '{{$pasien->pasien_in}}', '{{$pasien->pasien_out}}', '{{$pasien->pasien_sum}}', '{{$pasien->pasien_room}}', '{{$pasien->pasien_diagnoses}}', '{{ $pasien->pasien_discount}}')"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="edit" class="badge bg-warning border-0"><i
                        class="bi bi-pencil-square me-1"></i></button>
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
</table>
<!-- End Table with stripped rows -->

@include('partials.footer')
<script>
    $(document).ready(function() {
        let userRoll = {{ auth()->user()->role_id}};
        if (userRoll === 1) {
            $('#pasienTable').DataTable({
                ordering: false,
                info: false,
                paging: false,
                searching: false,
                dom: 'Bfrtip',
                buttons: [
                    {
                    extend: 'excel',
                    className: 'btn btn-success mb-3 me-2',
                    text: '<i class="bi bi-file-earmark-excel"></i> Excel'
                    },
                    {
                    extend: 'pdf',
                    className: 'btn btn-danger mb-3 me-2',
                    text: '<i class="bi bi-file-earmark-pdf"></i> PDF'
                    },
                    {
                    extend: 'print',
                    className: 'btn btn-primary mb-3 me-2',
                    text: '<i class="bi bi-printer"></i> Print'
                    }
                ],
            });
        
            // Add a separate "Print All Notes" button on the right with a print icon
            let printAllBtn = $('<button>')
                .addClass('btn btn-primary mb-3 float-end')
                .html('<i class="bi bi-printer me-1"></i> Nota')
                .on('click', function() {
                window.open('{{ route("pasien.print") }}', '_blank');
                });
            
                $('#pasienTable').before(printAllBtn);
        }
    });
</script>