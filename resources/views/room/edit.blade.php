@extends('layouts.main')
@section('title','DASBOARD')

@section('content')

<div class="pagetitle">
    <h1>Ubah Perawatan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('room.index')}}">Ubah</a></li>
            <li class="breadcrumb-item active">Ubah</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body">

            <!-- General Form Elements -->
            <form method="POST" action="{{ route('room.update', $room->id)}}" class="g-3 needs-validation"
                class="modal-form" novalidate>
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="room_name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('room_name') is-invalid @enderror" id="room_name"
                            name="room_name" value="{{ old('room_name', $room->room_name)}}">
                        @error('room_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="room_price" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('room_price') is-invalid @enderror"
                            id="room_price" name="room_price" value="{{ old('room_price', $room->room_price)}}">
                        @error('room_price')
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