@extends('layouts.main')
@section('title','PENUNJANG')

@section('content')

<div class="pagetitle">
    <h1>Penunjang</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('suport.index')}}">Penunjang</a></li>
            <li class="breadcrumb-item active">Ubah</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body m-3">

            <!-- General Form Elements -->
            <form method="POST" action="{{ route('suport.update', $suport->id)}}" class="g-3 needs-validation"
                class="modal-form" novalidate>
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="suport_name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('suport_name') is-invalid @enderror"
                            id="suport_name" name="suport_name" value="{{ old('suport_name', $suport->suport_name)}}">
                        @error('suport_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="suport_price" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('suport_price') is-invalid @enderror"
                            id="suport_price" name="suport_price"
                            value="{{ old('suport_price', $suport->suport_price)}}">
                        @error('suport_price')
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