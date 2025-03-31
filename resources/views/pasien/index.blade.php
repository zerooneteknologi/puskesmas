@extends('layouts.main')
@section('title','PASIEN')

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

            <!-- Table with stripped rows -->
            <table class="table datatable table-hover">
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
</section>

<!-- Vertically centered Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
    Vertically centered
</button>
<div class="modal fade" id="modaldiscount" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Dikon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Horizontal Form -->
                <form action="{{ route('pasien.update', $pasien->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row mb-3">
                        <label for="pasien_id" class="col-sm-2 col-form-label">id Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_id" name="pasien_id">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pasien_nomor" class="col-sm-2 col-form-label">Nomor Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_nomor" name="pasien_nomor">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pasien_name" class="col-sm-2 col-form-label">Nama Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_name" name="pasien_name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pasien_age" class="col-sm-2 col-form-label">Umur Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_age" name="pasien_age">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pasien_address" class="col-sm-2 col-form-label">Alamat Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_address" name="pasien_address">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pasien_status" class="col-sm-2 col-form-label">Status Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_status" name="pasien_status">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pasien_in" class="col-sm-2 col-form-label">Masuk Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_in" name="pasien_in">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pasien_out" class="col-sm-2 col-form-label">Keluar Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_out" name="pasien_out">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pasien_sum" class="col-sm-2 col-form-label">Jumlah HP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_sum" name="pasien_sum">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pasien_room" class="col-sm-2 col-form-label">Ruangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_room" name="pasien_room">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pasien_diagnoses" class="col-sm-2 col-form-label">Diagnosa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_diagnoses" name="pasien_diagnoses">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pasien_discount" class="col-sm-2 col-form-label">Diskon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pasien_discount" name="pasien_discount">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End Horizontal Form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
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
</script>
@endpush