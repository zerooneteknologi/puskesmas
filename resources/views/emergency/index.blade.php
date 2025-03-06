@extends('layouts.main')
@section('title','UGD')

@section('content')

<div class="pagetitle">
    <h1>UGD</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">UGD</li>
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

            <div class="row">
                <div class="col-6">
                    <h5 class="card-title">UGD</h5>
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
                    @foreach ($emergencies as $emergency)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $emergency->emergency_name }}</td>
                        <td>{{ $emergency->emergency_price }}</td>
                        <td>
                            <a href="{{ route('emergency.edit', $emergency->id )}}" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Edit" {{--
                                onclick="edit({{ $emergency->id }}, '{{ $emergency->emergency_name }}', '{{ $emergency->emergency_price}}')"
                                --}} class="badge bg-warning border-0"><i class="bi bi-pencil-square me-1"></i></a>
                            <form id="deleted-form" action="{{ route('emergency.destroy', $emergency->id) }}"
                                method="POST" class="d-inline">
                                <button class="badge bg-danger  border-0" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Hapus"
                                    onClick="return confirm(`Apakah Yakin hapus {{ $emergency->emergency_name}}?`)">
                                    <i class="bi bi-trash"></i></button>
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Table with stripped rows -->

        </div>
    </div>
</section>

<!-- Vertically centered Modal-->
<div class="modal fade" id="emergencyModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- General Form Elements -->
            <form method="POST" action="" class="g-3 needs-validation" class="modal-form" novalidate>
                @csrf

                <input type="hidden" name="_method" class="method">

                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="emergency_name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('emergency_name') is-invalid @enderror"
                                id="emergency_name" name="emergency_name">
                            @error('emergency_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="emergency_price" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('emergency_price') is-invalid @enderror"
                                id="emergency_price" name="emergency_price">
                            @error('emergency_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form><!-- End General Form Elements -->
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

@endsection

@push('script')
<script>
    /**
    * show modal create
    */
    $('.btn-add').click(function (e) {
        $('.modal-title').html('Tambah perawatan UGD');
        $('.modal-form').attr('action', "{{ route('emergency.store')}}")
        $('.method').val('POST');
        $('#emergency_name').val('');
        $('#emergency_price').val('');
        $('#emergencyModal').modal('show');
    })

    /**
    * show modal edit
    */
    function edit(id, emergency_name, emergency_price) {
        $('.modal-title').html('Edit perawtan UGD');
        $('.modal-form').attr('action', "/emergency/" + id);
        $('.method').val('PUT');
        $('#emergency_name').val(emergency_name);
        $('#emergency_price').val(emergency_price);
        $('#emergencyModal').modal('show');
    }
</script>
@endpush