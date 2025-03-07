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
                    <label for="numberInput" class="col-sm-2 col-form-label">Harga (Rp)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('numberInput') is-invalid @enderror"
                            id="numberInput" name="numberInput"
                            value="{{ old('numberInput', number_format($laboratory->laboratory_price))}}">
                        <input type="hidden" id="laboratory_price" name="laboratory_price"
                            value="{{ $laboratory->laboratory_price}}">
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

@push('script')
<script>
    /**
     * format number
     */
    const number = document.getElementById('laboratory_price');
    const input = document.getElementById('numberInput');
    
    input.addEventListener('input', function (e) {
        // Ambil nilai input dan hapus semua karakter non-digit
        let value = e.target.value.replace(/[^0-9]/g, '');
        // number.value(value)
        // Ubah string angka menjadi number
        let numberValue = parseFloat(value);
        
        // Format angka dengan pemisah ribuan
        let formattedValue = new Intl.NumberFormat().format(numberValue);
        
        // Set nilai input ke format yang sudah diformat
        e.target.value = formattedValue;

        let rawValue = input.value.replace(/[^0-9]/g, ''); // Hapus koma dan karakter non-digit

        if (!rawValue || isNaN(rawValue)) {
            alert('Input harus berupa angka!');
            return; // Hentikan proses
        }
        let numberFormat = parseFloat(rawValue); // Konversi ke number
        number.value = numberFormat;
    });
</script>
@endpush