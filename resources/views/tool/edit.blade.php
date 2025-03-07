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
                    <label for="numberInput" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('numberInput') is-invalid @enderror"
                            id="numberInput" name="numberInput"
                            value="{{ old('numberInput', number_format($tool->tool_price))}}">
                        <input type="hidden" id="tool_price" name="tool_price" value="{{ $tool->tool_price }}">
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

@push('script')
<script>
    /**
     * format number
     */
    const number = document.getElementById('tool_price');
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