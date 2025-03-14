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
                <label for="numberInput" class="col-sm-2 col-form-label">Harga (Rp)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('numberInput') is-invalid @enderror" id="numberInput"
                        name="numberInput" value="{{ old('numberInput', number_format($action->action_price))}}">
                    <input type="hidden" id="action_price" name="action_price" value="{{ $action->action_price}}">
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

@push('script')
<script>
    /**
     * format number
     */
    const number = document.getElementById('action_price');
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