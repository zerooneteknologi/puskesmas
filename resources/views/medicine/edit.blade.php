@extends('layouts.main')
@section('title','OBAT')

@section('content')

<div class="pagetitle">
    <h1>Ubah Obat</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('medicine.index')}}">Obat</a></li>
            <li class="breadcrumb-item active">Ubah</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body m-3">

            <form method="POST" action="{{ route('medicine.update', $medicine->id )}}" class="g-3 needs-validation"
                class="modal-form" novalidate>
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="medicine_name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('medicine_name') is-invalid @enderror"
                            id="medicine_name" name="medicine_name"
                            value="{{ old('medicine_name', $medicine->medicine_name)}}">
                        @error('medicine_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="medicine_price" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('medicine_price') is-invalid @enderror"
                            id="medicine_price" name="medicine_price"
                            value="{{ old('medicine_price', $medicine->medicine_price)}}">
                        @error('medicine_price')
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