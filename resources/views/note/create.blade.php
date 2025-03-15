<table class="table datatable table-hover" id="emergency">
    <thead>
        <tr>
            <th>
                No
            </th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bills as $bill)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <input type="hidden" name="note_category[]" value="{{ $bill->bill_category}}">
                <input type="text" class="form-control-plaintext" value="{{ $bill->bill_name }}" name="note_name[]">
            </td>
            <td>
                <input type="hidden" name="note_price[]" value="{{ $bill->bill_price}}"> Rp. {{
                number_format($bill->bill_price,2,",",".") }}
            </td>
            <td>
                <button
                    onclick="removeBill({{ $bill->id }}, {{request()->category}}, '{{ $bill->bill_name}}', '{{ $bill->bill_price}}')"
                    class="badge bg-danger  border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                    <i class="bi bi-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- End Table with stripped rows -->

<div class="row">
    <span class="text-bold col-md-6"><strong>Jumlah</strong></span>
    <span class="col-md-6 text-end"><strong>Rp. {{ number_format($total,"2", ",", ".")}}</strong></span>
</div>