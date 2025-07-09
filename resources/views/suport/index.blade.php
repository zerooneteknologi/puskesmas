@extends('layouts.main')
@section('title','PENUNJANG')

@section('content')

<div class="pagetitle">
    <h1>Perawatan Penunjang</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Perawtan Penunjang</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body">

            <!-- Flash Message -->
            @if (session()->has('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <i class="bi bi-star me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- end Flash Message -->

            <div class="row">
                <div class="col-6">
                    <h5 class="card-title">Daftar Perawatan Penunjang</h5>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-secondary float-end mt-3 btn-add">
                        <i class="bi bi-plus me-1"></i> Tambah
                    </button>
                    <button type="button" class="btn btn-success float-end mt-3 me-2 btn-import">
                        <i class="bi bi-upload me-1"></i> Import
                    </button>
                </div>
            </div>
            <!-- Table with stripped rows -->
            <table class="table datatable table-hover">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suports as $suport)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $suport->suport_name }}</td>
                        <td>Rp. {{ number_format($suport->suport_price,2,",",".") }}</td>
                        <td>
                            <a href="{{ route('suport.edit', $suport->id)}}" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Edit" class="badge bg-warning border-0"><i
                                    class="bi bi-pencil-square me-1"></i></a>
                            <form id="deleted-form" action="{{ route('suport.destroy', $suport->id) }}" method="POST"
                                class="d-inline">
                                <button class="badge bg-danger  border-0" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Hapus"
                                    onClick="return confirm(`Apakah Yakin hapus {{ $suport->suport_name}}?`)">
                                    <i class="bi bi-trash"></i></button>
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Table with stripped rows -->

        </div>
    </div>
</section>

<!-- Vertically centered Modal-->
<div class="modal fade" id="suportModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- General Form Elements -->
            <form method="POST" action="" class="g-3 needs-validation" class="modal-form" enctype="multipart/form-data"
                novalidate>
                @csrf

                <input type="hidden" name="_method" class="method">

                <div class="modal-body">
                    {{-- name --}}
                    <div class="row mb-3" id="suportname" style="display: none">
                        <label for="suport_name" class="col-sm-2 col-form-label">Nama Penunjang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('suport_name') is-invalid @enderror"
                                id="suport_name" name="suport_name">
                            @error('suport_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- price --}}
                    <div class="row mb-3" id="suportprice" style="display: none">
                        <label for="numberInput" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('numberInput') is-invalid @enderror"
                                id="numberInput" name="numberInput">
                            <input type="hidden" id="suport_price" name="suport_price">
                            @error('suport_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- file --}}
                    <div class="row mb-3" id="suportfile" style="display: none">
                        <label for="suport_file" class="col-sm-2 col-form-label">File</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control @error('suport_file') is-invalid @enderror"
                                id="suport_file" name="suport_file">
                            <a href="{{ asset('file/penunjang.xlsx') }}" class="btn btn-link mt-2" download>
                                <i class="bi bi-download"></i>Download Template
                            </a>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form><!-- End General Form Elements -->
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

@endsection

@push('script')
<script>
    /**
    * show modal create
    */
    $('.btn-add').click(function (e) {
        $('.modal-title').html('Tambah Penujang');
        $('.modal-form').attr('action', "{{ route('suport.store')}}")
        $('.method').val('POST');
        $('#suportname').css('display', 'flex');
        $('#suportprice').css('display', 'flex');
        $('#suportfile').css('display', 'none');
        $('#suport_name').val('');
        $('#suport_price').val('');
        $('#suportModal').modal('show');
    })

    /**
     * show modal import
     */
    $('.btn-import').click(function (e) {
        $('.modal-title').html('Import Penujang');
        $('.modal-form').attr('action', "{{ route('suport.store')}}")
        $('.method').val('POST');
        $('#suportname').css('display', 'none');
        $('#suportprice').css('display', 'none');
        $('#suportfile').css('display', 'flex');
        $('#suportModal').modal('show');
    })

    /**
    * format number
    */
    const number = document.getElementById('suport_price');
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