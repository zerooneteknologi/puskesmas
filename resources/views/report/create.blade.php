@include('partials.meta')
<table class="table datatable table-bordered" id="tableNote">
    <thead>
        <tr>
            <th>Tanggal</th>
            @php
            $categoryNames = [
            '1' => 'UGD',
            '2' => 'Perawatan',
            '3' => 'Labolatorium',
            '4' => 'Tind Umum',
            '5' => 'Tind Penunjang',
            '6' => 'Alat Kesehatan',
            '7' => 'Obat-Obatan',
            '8' => 'PONED',
            '9' => 'Tind Gigi',
            ];
            @endphp

            @foreach ($categories as $category)
            @if(isset($categoryNames[$category]))
            <th>{{ $categoryNames[$category] }}</th>
            @endif
            @endforeach
        </tr>
    </thead>
    @foreach ($notes as $note)
    <tr>
        <td>{{ $note['note_date']}}</td>
        <td>{{ number_format($note['1'],0,",",".")}}</td>
        <td>{{ number_format($note['2'],0,",",".")}}</td>
        <td>{{ number_format($note['3'],0,",",".")}}</td>
        <td>{{ number_format($note['4'],0,",",".")}}</td>
        <td>{{ number_format($note['5'],0,",",".")}}</td>
        <td>{{ number_format($note['6'],0,",",".")}}</td>
        <td>{{ number_format($note['7'],0,",",".")}}</td>
        <td>{{ number_format($note['8'],0,",",".")}}</td>
        <td>{{ number_format($note['9'],0,",",".")}}</td>
    </tr>
    @endforeach
    <tbody>
    </tbody>
</table>

@include('partials.footer')
@include('partials.footer')
<script>
    $(document).ready(function() {
        $('#tableNote').DataTable({
            ordering: false,
            info: false,
            paging: false,
            searching: false,
            dom: 'Bfrtip', // Menambahkan tombol ekspor
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
    });
</script>