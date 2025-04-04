@extends('layouts.main')
@section('title','SETTINGS')

@section('content')

<div class="pagetitle">
    <h1>Staff</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Pengaturan</li>
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
                    <h5 class="card-title">Pengaturan Staff </h5>
                </div>
                <div class="col-6">
                    <button type="button" class="badge rounded-pill bg-light text-dark float-end mt-3 border-0 btn-add">
                        <i class="bi bi-pencil-square me-1"></i>
                    </button>
                </div>
            </div>
            <!-- Table with stripped rows -->
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th>Kepala UPT</th>
                        <td style="width: 5%">:</td>
                        <td>{{ $personnel->personnel_director }}</td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <td style="width: 5%">:</td>
                        <td>{{ $personnel->personnel_nip }}</td>
                    </tr>
                    <tr>
                        <th>Bendahara</th>
                        <td style="width: 5%">:</td>
                        <td>{{ $personnel->personnel_treasurer }}</td>
                    </tr>
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
                <form method="POST" action="{{ route('personnel.update', $personnel->id)}}" class="g-3 needs-validation"
                    class="modal-form" novalidate>
                    @csrf

                    <input type="hidden" name="_method" class="method" value="PUT">
                    <input type="hidden" name="id" id="personnel_id" value="{{ $personnel->id}}">

                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="personnel_director" class="col-sm-2 col-form-label">Kepala UPT</label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="form-control @error('personnel_director') is-invalid @enderror"
                                    id="personnel_director" name="personnel_director"
                                    value="{{ $personnel->personnel_director }}">
                                @error('personnel_director')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="personnel_nip" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('personnel_nip') is-invalid @enderror"
                                    id="personnel_nip" name="personnel_nip" value="{{ $personnel->personnel_nip }}">
                                @error('personnel_nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="personnel_treasurer" class="col-sm-2 col-form-label">Bendahara</label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="form-control @error('personnel_treasurer') is-invalid @enderror"
                                    id="personnel_treasurer" name="personnel_treasurer"
                                    value="{{ $personnel->personnel_treasurer }}">
                                @error('personnel_treasurer')
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
     * show modal update personnel
    */
    $('.btn-add').click(function (e) {
        $('.modal-title').html('Edit staff');
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