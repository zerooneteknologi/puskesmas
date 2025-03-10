@include('partials.meta')

<div class="row">
    <div class="col-6">
        <h5 class="card-title">{{ $title }}</h5>
    </div>
    <div class="col-6">
        <button type="button" class="btn btn-secondary float-end mt-3 btn-add">
            <i class="bi bi-plus me-1"></i> Tambah
        </button>
    </div>
</div>
<!-- Table with stripped rows -->
<table class="table datatable table-hover">
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

        @foreach ($data as $laboratory)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $laboratory->laboratory_name }}</td>
            <td>Rp. {{ number_format($laboratory->laboratory_price,2,",",".") }}</td>
            <td>
                <a href="{{ route('laboratory.edit', $laboratory->id)}}" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Edit" class="badge bg-warning border-0"><i
                        class="bi bi-pencil-square me-1"></i></a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
<!-- End Table with stripped rows -->

@include('partials.footer')