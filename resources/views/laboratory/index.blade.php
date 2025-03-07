@extends('layouts.main')
@section('title','Laboratorium')

@section('content')

<div class="pagetitle">
    <h1>Laboratorium</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Laboratorium</li>
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
                    <h5 class="card-title">Daftar Laboratorium</h5>
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
                    @foreach ($laboratories as $laboratory)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $laboratory->laboratory_name }}</td>
                        <td>{{ $laboratory->laboratory_price }}</td>
                        <td>
                            <a href="{{ route('laboratory.edit', $laboratory->id )}}" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Edit" class="badge bg-warning border-0"><i
                                    class="bi bi-pencil-square me-1"></i></a>
                            <form id="deleted-form" action="{{ route('laboratory.destroy', $laboratory->id) }}"
                                method="POST" class="d-inline">
                                <button class="badge bg-danger  border-0" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Hapus"
                                    onClick="return confirm(`Apakah Yakin hapus {{ $laboratory->laboratory_name}}?`)">
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
<div class="modal fade" id="laboratoryModal" tabindex="-1">
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
                        <label for="laboratory_name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('laboratory_name') is-invalid @enderror"
                                id="laboratory_name" name="laboratory_name">
                            @error('laboratory_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="laboratory_price" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('laboratory_price') is-invalid @enderror"
                                id="laboratory_price" name="laboratory_price">
                            @error('laboratory_price')
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
        $('.modal-title').html('Tambah Laboratorium');
        $('.modal-form').attr('action', "{{ route('laboratory.store')}}")
        $('.method').val('POST');
        $('#laboratory_name').val('');
        $('#laboratory_price').val('');
        $('#laboratoryModal').modal('show');
    })

    /**
    * show modal edit
    */
    function edit(id, laboratory_name, laboratory_price) {
        $('.modal-title').html('Edit perawtan UGD');
        $('.modal-form').attr('action', "/laboratory/" + id);
        $('.method').val('PUT');
        $('#laboratory_name').val(laboratory_name);
        $('#laboratory_price').val(laboratory_price);
        $('#laboratoryModal').modal('show');
    }
</script>
@endpush