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

        <div id="tableTapsien">
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
                            <a href="{{ route('pasien.show', $pasien->id)}}" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="rincian" class="badge bg-primary border-0"><i
                                    class="bi bi-printer me-1"></i></a>
                            <button type="button"
                                onclick="discount({{ $pasien->id }}, '{{ $pasien->pasien_nomor}}', '{{$pasien->pasien_name}}', '{{ $pasien->pasien_age}}', '{{ $pasien->pasien_address}}', '{{ $pasien->pasien_status}}', '{{$pasien->pasien_in}}', '{{$pasien->pasien_out}}', '{{$pasien->pasien_sum}}', '{{$pasien->pasien_room}}', '{{$pasien->pasien_diagnoses}}', '{{ $pasien->pasien_discount}}')"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="edit"
                                class="badge bg-warning border-0"><i class="bi bi-pencil-square me-1"></i></button>

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

<!-- Vertically centered Modal -->
<div class="modal fade" id="modaldiscount" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Dikon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if ($pasiens->count() !== 0)
            <form action="{{ route('pasien.update', $pasien->id)}}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Horizontal Form -->
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" class="form-control" id="pasien_id" name="pasien_id">
                    <input type="hidden" class="form-control" id="pasien_nomor" name="pasien_nomor">
                    <input type="hidden" class="form-control" id="pasien_name" name="pasien_name">
                    <input type="hidden" class="form-control" id="pasien_age" name="pasien_age">
                    <input type="hidden" class="form-control" id="pasien_address" name="pasien_address">
                    <input type="hidden" class="form-control" id="pasien_status" name="pasien_status">
                    <input type="hidden" class="form-control" id="pasien_in" name="pasien_in">
                    <input type="hidden" class="form-control" id="pasien_out" name="pasien_out">
                    <input type="hidden" class="form-control" id="pasien_sum" name="pasien_sum">
                    <input type="hidden" class="form-control" id="pasien_room" name="pasien_room">
                    <input type="hidden" class="form-control" id="pasien_diagnoses" name="pasien_diagnoses">
                    <div class="row mb-3">
                        <label for="pasien_discount" class="col-sm-2 col-form-label">Diskon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_discount" name="pasien_discount">
                        </div>
                    </div>
                    <div class="text-center">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah diskon</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form><!-- End Horizontal Form -->
            @endif
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

@endsection

@push('script')
<script>
    function discount(id, nomor, name, age, address, status, pasienIn, out, sum, room, diagnoses, discount) {
            $('#pasien_id').val(id);
            $('#pasien_nomor').val(nomor);
            $('#pasien_name').val(name);
            $('#pasien_age').val(age);
            $('#pasien_address').val(address);
            $('#pasien_status').val(status);
            $('#pasien_in').val(pasienIn);
            $('#pasien_out').val(out);
            $('#pasien_sum').val(sum);
            $('#pasien_room').val(room);
            $('#pasien_diagnoses').val(diagnoses);
            $('#pasien_discount').val(discount);
            $('#modaldiscount').modal('show');
        }

    $('#filter').on('change', function() {
        $('#filterDate').css('display', 'none');
        $('#filterMonth').css('display', 'none');
        $('#filterYear').css('display', 'none');
        const selectedFilter = $('#filter').val();
        switch(selectedFilter) {
        case '1':
        $('#filterDate').css('display', 'flex');
        break;
        case '2':
        $('#filterMonth').css('display', 'flex');
        break;
        case '3':
        $('#filterYear').css('display', 'flex');
        break;
        }
    })

    function filter() {
        $.get('/filter', $('#form').serialize() , function(e) {
        $('#tableTapsien').html(e)
        })
    }
    

    $('#date').on('change', function(data) {
        filter()
    })
    $('#month').on('change', function() {
        filter()
    })
    $('#year').on('change', function() {
        filter()
    })

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
@endpush