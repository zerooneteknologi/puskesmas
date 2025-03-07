@extends('layouts.main')
@section('title','PERALATAN')

@section('content')

<div class="pagetitle">
    <h1>Ubah Peralatan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tool.index')}}">Peralatan</a></li>
            <li class="breadcrumb-item active">Ubah</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body mt-3">

            <!-- General Form Elements -->
            <form method="POST" action="{{ route('tool.update', $tool->id) }}" class="g-3 needs-validation"
                class="modal-form mt-3" novalidate>
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="tool_name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('tool_name') is-invalid @enderror" id="tool_name"
                            name="tool_name" value="{{ old('tool_name', $tool->tool_name)}}">
                        @error('tool_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tool_price" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('tool_price') is-invalid @enderror"
                            id="tool_price" name="tool_price" value="{{ old('tool_price', $tool->tool_price)}}">
                        @error('tool_price')
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