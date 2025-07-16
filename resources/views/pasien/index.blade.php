@extends('layouts.main')
@section('title','DAFTAR PASIEN')

@section('content')

<div class="pagetitle">
    <h1>Pasien</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Pasien</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body">

            <!-- Flash Message -->
            @if (session()->has('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <i class="bi bi-star me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- end Flash Message -->

            <h5 class="card-title">Daftar Pasien</h5>

            <form action="" method="GET" id="form">
                @csrf
                <div class="row mt-3">
                    <label for="filter" class="form-label col-md-2"><i class="bi bi-filter"></i> Filter</label>
                    <div class="col-md-4 mb-3">
                        <select class="form-select" id="filter" name="filter" required>
                            <option selected disabled value="">Pilih jenis filter</option>
                            <option value="1">Harian</option>
                            <option value="2">Bulanan</option>
                            <option value="3">Tahunan</option>
                        </select>
                    </div>
                    <div class="col-md-6 row" style=" display: none" id="filterDate">
                        <label for="date" class="form-label col-md-4">Harian</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
                        </div>
                    </div>
                    <div class="col-md-6 row" style=" display: none" id="filterMonth">
                        <label for="month" class="form-label col-md-4">Bulanan</label>
                        <div class="col-md-8">
                            <input type="month" name="month" id="month" class="form-control"
                                value="{{ request('month') }}">
                        </div>
                    </div>
                    <div class="col-md-6 row" style=" display: none" id="filterYear">
                        <label for="year" class="form-label col-md-4">Tahunan</label>
                        <div class="col-md-8">
                            <select name="year" id="year" name="year" class="form-control">
                                <option value="">Pilih Tahun</option>
                                @for ($year = date('Y'); $year >= 2024; $year--)
                                <option value="{{ $year }}" {{ request('year')==$year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <!-- Table with stripped rows -->
            <table class="table table-hover" id="pasienTable">
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
            </table>
            <!-- End Table with stripped rows -->
        </div>

    </div>
    </div>
</section>


@endsection

@push('script')
<script>
    $(document).ready(function() {
        filter();
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

    let filterTimeout;

    $('#filter').on('change', function() {
        $('#filterDate, #filterMonth, #filterYear').hide();
        $('#date, #month, #year').val('');
        const selectedFilter = $(this).val();
        if (selectedFilter === '1') $('#filterDate').css('display', 'flex');
        else if (selectedFilter === '2') $('#filterMonth').css('display', 'flex');
        else if (selectedFilter === '3') $('#filterYear').css('display', 'flex');
    });

    // Tambah elemen loading melayang di tengah
    let loadingDiv = $(`
        <div id="loadingPasien" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(255,255,255,0.5); z-index: 9999; display: flex; align-items: center; justify-content: center;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `);
    loadingDiv.hide();
    $('#pasienTable').before(loadingDiv);

    function filter() {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(function() {
            $('#loadingPasien').show();
            $.get('/filter', $('#form').serialize(), function(e) {
                $('#pasienTable').html(e);
                $('#loadingPasien').hide();
            });
        }, 300); // debounce 300ms
    }

    $('#date, #month, #year').on('change input', filter);
</script>
@endpush