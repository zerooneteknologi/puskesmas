@extends('layouts.main')
@section('title','STAFF')

@section('content')

<div class="pagetitle">
    <h1>Staff</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Staff</li>
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
                    <h5 class="card-title">Daftar Anggota/Staff</h5>
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
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personnels as $personnel)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $personnel->personnel_name }}</td>
                        <td>{{ $personnel->personnel_nip }}</td>
                        <td>{{ $personnel->personnel_role }}</td>
                        <td>
                            <a href="{{ route('personnel.edit', $personnel->id)}}" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Edit" {{--
                                onclick="edit( {{ $personnel->id }}, '{{$personnel->personnel_name}}', '{{ $personnel->personnel_nip }}', '{{ $personnel->personnel_role }}' )"
                                --}} class="badge bg-warning border-0"><i class="bi bi-pencil-square me-1"></i></a>
                            <form id="deleted-form" action="{{ route('personnel.destroy', $personnel->id) }}"
                                method="POST" class="d-inline">
                                <button class="badge bg-danger  border-0" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Hapus"
                                    onClick="return confirm(`Apakah Yakin hapus Partner {{ $personnel->personnel_name}}?`)">
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

    <!-- Vertically centered Modal-->
    <div class="modal fade" id="personnelModal" tabindex="-1">
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
                    {{-- <input type="text" name="id" id="personnel_id"> --}}

                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="personnel_name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('personnel_name') is-invalid @enderror"
                                    id="personnel_name" name="personnel_name">
                                @error('personnel_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="personnel_nip" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('personnel_nip') is-invalid @enderror"
                                    id="personnel_nip" name="personnel_nip">
                                @error('personnel_nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="personnel_role" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('personnel_role') is-invalid @enderror"
                                    id="personnel_role" name="personnel_role">
                                @error('personnel_role')
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
</section>

@endsection

@push('script')
<script>
    /**
     * show modal create
    */
    $('.btn-add').click(function (e) {
        $('.modal-title').html('Tambah Anggota');
        $('.modal-form').attr('action', "{{ route('personnel.store')}}");
        $('.method').val('POST')
        $('#personnel_name').val('')
        $('#personnel_nip').val('')
        $('#personnel_role').val('')
        $('#personnelModal').modal('show');
    })

    /**
    * show modal edit
    */
    function edit(id, personnel_name, personnel_nip, personnel_role) {
    $('.modal-title').html('Edit Anggota');
    $('.btn-sumbmit').html('Edit')
    $('.modal-form').attr('action', "/personnel/" + id);
    $('.method').val('PATCH')
    $('#personnel_name').val(personnel_name)
    $('#personnel_nip').val(personnel_nip)
    $('#personnel_role').val(personnel_role)
    $('#personnel_id').val(id)
    $('#personnelModal').modal('show');
    }
</script>
@endpush