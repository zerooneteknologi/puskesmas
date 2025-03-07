@extends('layouts.main')
@section('title','Tindakan')

@section('content')

<div class="pagetitle">
    <h1>Tindakan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('action.index')}}">Tindakan</a></li>
            <li class="breadcrumb-item active">Ubah</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <!-- General Form Elements -->
        <form method="POST" action="{{ route('action.update', $action->id)}}" class="g-3 needs-validation"
            class="modal-form" novalidate>
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="action_category">Kategori</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" id="action_category"
                        name="action_category" required>
                        <option value="">Pilih Kategori</option>
                        <option value="1" {{ old('action_category', $action->action_category ) == 1 ? 'selected' :
                            ''}}>Umum</option>
                        <option value="2" {{ old('action_category', $action->action_category ) == 2 ? 'selected' :
                            ''}}>Bidan</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="action_name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('action_name') is-invalid @enderror" id="action_name"
                        name="action_name" value="{{ old('action_name', $action->action_name) }}">
                    @error('action_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="action_price" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('action_price') is-invalid @enderror"
                        id="action_price" name="action_price" value="{{ old('action_price', $action->action_price)}}">
                    @error('action_price')
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
</section>

@endsection