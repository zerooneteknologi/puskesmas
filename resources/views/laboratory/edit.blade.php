@extends('layouts.main')
@section('title','Laboratorium')

@section('content')

<div class="pagetitle">
    <h1>Ubah Laboratorium</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('laboratory.index')}}">Laboratorium</a></li>
            <li class="breadcrumb-item active">Ubah</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body">

            <!-- General Form Elements -->
            <form method="POST" action="{{ route('laboratory.update', $laboratory->id)}}"
                class="g-3 needs-validation mt-3" class="modal-form" novalidate>
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="laboratory_name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('laboratory_name') is-invalid @enderror"
                            id="laboratory_name" name="laboratory_name"
                            value="{{ old('laboratory_name', $laboratory->laboratory_name)}}">
                        @error('laboratory_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="laboratory_price" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('laboratory_price') is-invalid @enderror"
                            id="laboratory_price" name="laboratory_price"
                            value="{{ old('laboratory_price', $laboratory->laboratory_price)}}">
                        @error('laboratory_price')
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