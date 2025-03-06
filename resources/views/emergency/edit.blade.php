@extends('layouts.main')
@section('title','UGD')

@section('content')

<div class="pagetitle">
    <h1>Edit Perawtan UGD</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('emergency.index')}}">UGD</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body">
            <!-- General Form Elements -->
            <form method="POST" action="/emergency/ {{ $emergency->id}}" class="g-3 needs-validation" class="modal-form"
                novalidate>
                @csrf
                @method("PUT")

                <div class="row mb-3">
                    <label for="emergency_name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('emergency_name') is-invalid @enderror"
                            id="emergency_name" name="emergency_name"
                            value="{{ old('emergency_name', $emergency->emergency_name)}}">
                        @error('emergency_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="emergency_price" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('emergency_price') is-invalid @enderror"
                            id="emergency_price" name="emergency_price"
                            value="{{ old('emergency_price', $emergency->emergency_price)}}">
                        @error('emergency_price')
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