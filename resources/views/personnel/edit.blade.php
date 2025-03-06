@extends('layouts.main')
@section('title','STAFF')

@section('content')

<div class="pagetitle">
    <h1>Edit Staff</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('personnel.index')}}">Staff</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body">
            <!-- General Form Elements -->
            <form method="POST" action="/personnel/ {{ $personnel->id}}" class="g-3 needs-validation" class="modal-form"
                novalidate>
                @csrf

                <input type="hidden" name="_method" class="method" value="PUT">
                <div class="row mb-3">
                    <label for="personnel_name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('personnel_name') is-invalid @enderror"
                            id="personnel_name" name="personnel_name"
                            value="{{ old('personnel_name', $personnel->personnel_name)}}">
                        @error('personnel_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="personnel_nip" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('personnel_nip') is-invalid @enderror"
                            id="personnel_nip" name="personnel_nip"
                            value="{{ old('personnel_nip', $personnel->personnel_nip)}}">
                        @error('personnel_nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="personnel_role" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('personnel_role') is-invalid @enderror"
                            id="personnel_role" name="personnel_role"
                            value="{{ old('personnel_role', $personnel->personnel_role)}}">
                        @error('personnel_role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>

            </form><!-- End General Form Elements -->
        </div>
    </div>

</section>

@endsection