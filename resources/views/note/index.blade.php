@extends('layouts.main')
@section('title','Nota')

@section('content')

<style>
    #spinner {
        position: fixed;
        /* Spinner melayang */
        bottom: 60px;
        right: 20px;
        width: 40px;
        height: 40px;
        background-color: rgba(0, 0, 0, 0.7);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }

    .spinner-icon {
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top: 3px solid #ffffff;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .search-container {
        max-width: 400px;
        margin: 20px auto;
    }
</style>

<!-- Page Title -->
<div class="pagetitle d-flex justify-content-between align-items-center">
    <div>
        <h1>Nota Pembayaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Nota</li>
            </ol>
        </nav>
    </div>

    <div class="input-group search-container">
        <input type="text" class="form-control rounded-pill" placeholder="Cari pasien..." id="searchInput"
            autocomplete="off" data-bs-toggle="dropdown" aria-expanded="false" name="search">
        <ul class="dropdown-menu w-100" id="searchResults" style="max-height:200px; overflow-y:auto;"></ul>
    </div>

</div><!-- End Page Title -->


<section class="section">
    <!-- Custom Styled Validation -->
    <form class="g-3 needs-validation" method="POST" action="{{ route('note.store')}}" novalidate>
        @csrf
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Pasien</h5>
                <div class="row">
                    <input type="hidden" name="note_unit" value="{{ request()->unit}}">
                    <div class="col-md-6">

                        {{-- create random for time and byte --}}
                        @php
                        $randomValue = round(microtime(true) * 1000) . bin2hex(random_bytes(2));
                        @endphp
                        <input type="hidden" name="random_value" value="{{ $randomValue }}">

                        {{-- nik --}}
                        <div class="row mb-3">
                            <label for="pasien_nik" class="form-label col-md-4">
                                NIK Pasien <small class="text-danger">*</small>
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="pasien_nik" name="pasien_nik" required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                            </div>
                        </div>

                        {{-- name --}}
                        <div class="row mb-3">
                            <label for="pasien_name" class="form-label col-md-4">
                                Nama Pasien <small class="text-danger">*</small>
                            </label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="pasien_name" name="pasien_name"
                                        aria-describedby="basic-addon1" required>
                                </div>
                                <span class="invalid-feedback">Mohon Diisi</span>
                            </div>
                        </div>

                        {{-- age --}}
                        <div class="row mb-3">
                            <label for="pasien_age" class="form-label col-md-4">
                                Usia Pasien <small class="text-danger">*</small>
                            </label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" id="pasien_age" name="pasien_age" required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                            </div>
                        </div>

                        {{-- address --}}
                        <div class="row mb-3">
                            <label for="pasien_address" class="form-label col-md-4">
                                Alamat Pasien <small class="text-danger">*</small>
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="pasien_address" name="pasien_address"
                                    required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                            </div>
                        </div>

                        {{-- status --}}
                        <div class="row mb-3">
                            <label for="pasien_status" class="form-label col-md-4">
                                Status Pasien <small class="text-danger">*</small>
                            </label>
                            <div class="col-md-8">
                                <select class="form-select" id="pasien_status" name="pasien_status" required>
                                    <option selected disabled value="">
                                        Pilih status <small class="text-danger">*</small>
                                    </option>
                                    <option value="1">Umum</option>
                                    <option value="2">BPJS</option>
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan Pilih.
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        @if (request()->unit != 'd')
                        {{-- room --}}
                        <div class="row mb-3">
                            <label for="pasien_room" class="form-label col-md-4">
                                Ruangan <small class="text-danger">*</small>
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="pasien_room" name="pasien_room" required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                            </div>
                        </div>
                        @endif

                        {{-- Diagnosa --}}
                        @if (request()->unit == 'd')
                        <div class="row mb-3">
                            <label for="pasien_diagnoses" class="form-label col-md-4">
                                Diagnosa <small class="text-danger">*</small>
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="pasien_diagnoses" name="pasien_diagnoses"
                                    required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                            </div>
                        </div>
                        @endif

                        {{-- date in --}}
                        <div class="row mb-3">
                            @if (request()->unit == 'a' || request()->unit == 'd')
                            <label for="pasien_in" class="form-label col-md-4">
                                Tanggal Berobat <small class="text-danger">*</small>
                            </label>
                            @else
                            <label for="pasien_in" class="form-label col-md-4">
                                Tanggal Masuk <small class="text-danger">*</small>
                            </label>
                            @endif
                            <div class="col-md-8">
                                <input type="datetime-local" class="form-control" id="pasien_in" name="pasien_in"
                                    required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                            </div>
                        </div>

                        @if (request()->unit == 'b' || request()->unit == 'c')
                        {{-- date out --}}
                        <div class="row mb-3">
                            <label for="pasien_out" class="form-label col-md-4">Tanggal Keluar</label>
                            <div class="col-md-8">
                                <input type="datetime-local" class="form-control" id="pasien_out" name="pasien_out">
                            </div>
                        </div>

                        {{-- sum day --}}
                        <div class="row mb-3">
                            <label for="pasien_sum" class="form-label col-md-4">Jumlah HP</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="pasien_sum" name="pasien_sum">
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        @if (request()->unit != 'c')
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title">UGD</h5>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary float-end mt-3" onclick="add(1)">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>
                    </div>
                </div>
                <!-- Table with stripped rows -->
                <div id="emergency">
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
                    </table>

                    <div class="row">
                        <span class="text-bold col-md-6"><strong>Jumlah</strong></span>
                        <span class="col-md-6 text-end"><strong>Rp. {{ number_format(0)}}</strong></span>
                    </div>
                </div>


            </div>
        </div>
        @endif

        @if (request()->unit != 'd')
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title">Perawatan</h5>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary float-end mt-3 " onclick="add(2)">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>
                    </div>
                </div>
                <div id="room">
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
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                    <div class="row">
                        <span class="text-bold col-md-6"><strong>Jumlah</strong></span>
                        <span class="col-md-6 text-end"><strong>Rp. {{ number_format(0)}}</strong></span>
                    </div>
                </div>

            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title">Laboratorium</h5>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary float-end mt-3" onclick="add(3)">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>
                    </div>
                </div>

                <div id="laboratory">
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
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                    <div class="row">
                        <span class="text-bold col-md-6"><strong>Jumlah</strong></span>
                        <span class="col-md-6 text-end"><strong>Rp. {{ number_format(0)}}</strong></span>
                    </div>
                </div>

            </div>
        </div>

        @if (request()->unit == 'c')
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title">Tindakan Kebidanan</h5>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary float-end mt-3" onclick="add(8)">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>
                    </div>
                </div>

                <div id="midwife">
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
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                    <div class="row">
                        <span class="text-bold col-md-6"><strong>Jumlah</strong></span>
                        <span class="col-md-6 text-end"><strong>Rp. {{ number_format(0)}}</strong></span>
                    </div>
                </div>

            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title">Tindakan Gigi</h5>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary float-end mt-3" onclick="add(9)">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>
                    </div>
                </div>

                <div id="theet">
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
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                    <div class="row">
                        <span class="text-bold col-md-6"><strong>Jumlah</strong></span>
                        <span class="col-md-6 text-end"><strong>Rp. {{ number_format(0)}}</strong></span>
                    </div>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title">Tindakan Umum</h5>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary float-end mt-3" onclick="add(4)">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>
                    </div>
                </div>

                <div id="action">
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
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                    <div class="row">
                        <span class="text-bold col-md-6"><strong>Jumlah</strong></span>
                        <span class="col-md-6 text-end"><strong>Rp. {{ number_format(0)}}</strong></span>
                    </div>
                </div>

            </div>
        </div>

        @if (request()->unit == 'd')
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title">Pemeriksaan Penunjang</h5>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary float-end mt-3 " onclick="add(5)">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>
                    </div>
                </div>
                <div id="suport">
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
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                    <div class="row">
                        <span class="text-bold col-md-6"><strong>Jumlah</strong></span>
                        <span class="col-md-6 text-end"><strong>Rp. {{ number_format(0)}}</strong></span>
                    </div>
                </div>


            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title">Alat Keehatan</h5>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary float-end mt-3" onclick="add(6)">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>
                    </div>
                </div>

                <div id="tool">
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
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                    <div class="row">
                        <span class="text-bold col-md-6"><strong>Jumlah</strong></span>
                        <span class="col-md-6 text-end"><strong>Rp. {{ number_format(0)}}</strong></span>
                    </div>
                </div>


            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title">Obat - Obatan</h5>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary float-end mt-3" onclick="add(7)">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>
                    </div>
                </div>

                <div id="medicine">
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
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                    <div class="row">
                        <span class="text-bold col-md-6"><strong>Jumlah</strong></span>
                        <span class="col-md-6 text-end"><strong>Rp. {{ number_format(0)}}</strong></span>
                    </div>
                </div>


            </div>
        </div>

        <div class="card">
            <div class="card-body mt-3">

                <div class="col-12">
                    <button class="btn btn-primary" type="button" id="save">Simpan</button>
                    <a href="" class="btn btn-success d-none" id="print" target="blank"><i
                            class="bi bi-printer"></i></a>
                </div>
            </div>
        </div>

    </form><!-- End Custom Styled Validation -->

    <div id="spinner" style="display: none;">
        <div class="spinner-icon"></div>
    </div>

</section>

<!-- Vertically centered Modal -->
<div class="modal fade" id="tabelModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered"
                    data-bs-dismiss="modal">
                    Tambah Manual
                </button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

<div class="modal fade" id="verticalycentered" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" action="" class="g-3 needs-validation" class="modal-form" novalidate id="addform">
                <div class="modal-body">

                    <input type="hidden" name="category" id="note_category">

                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="note_name" name="name" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="price" class="col-sm-3 col-form-label">Harga (Rp)</label>
                        <div class="col-sm-9">
                            <input type="hidden" id="note_price" name="price">
                            <input type="text" class="form-control" id="numberInput" required>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-primary" onclick="addBill()" data-bs-dismiss="modal">Tambahkan</a>
                </div>
            </form><!-- End General Form Elements -->
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    /**
    * format number
    */
    const number = document.getElementById('note_price');
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

    /**
    * show modal create tabel rincian
    */
    function add(category) {
        $('#spinner').css('display', 'flex');
        $.get("{{ route('note.create')}}?category=" + category, function (data) {
            $('#modal-body').html(data);
            $('#tabelModal').modal('show');
            $('#note_category').val($('#categoy_id').val());        
            $('#spinner').css('display', 'none');
        })
    }

    /**
     * check category
     * @param {int} category
     * @param {string} data
     */
    function checkCategory(category, data) {
        if (category == 1) {
        $('#emergency').html(data)
        }
        if (category == 2) {
        $('#room').html(data)
        }
        if (category == 3) {
        $('#laboratory').html(data)
        }
        if (category == 4) {
        $('#action').html(data)
        }
        if (category == 5) {
        $('#suport').html(data)
        }
        if (category == 6) {
        $('#tool').html(data)
        }
        if (category == 7) {
        $('#medicine').html(data)
        }
        if (category == 8) {
        $('#midwife').html(data)
        }
        if (category == 9) {
        $('#theet').html(data)
        }
    }
    
    /**
     * add bill
     * @param {int} category
     * @param {string} name
     * @param {int} price
     */
    function emergency(category, name, price) {
        var button = $(event.target).closest('button');
        var icon = button.find('i');
        // Ambil nilai random dari input hidden
        var random = $('input[name="random_value"]').val();

        $.ajax({
            type: 'post',
            url: "{{ route('bill.store')}}",
            data: { 
            category : category, 
            name : name, 
            price: price,
            bill_code: random // kirim random value
            },
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
            },
            success: function(data){
            checkCategory(category, data)
            icon.removeClass('bi-plus-square');
            icon.addClass('bi-check2-square');
            button.removeClass('bg-info')
            button.addClass('bg-success')
            button.prop('disabled', true);
            button.attr('title', 'Ditambahkan')
            $('#spinner').css('display', 'none');
            }
        })
    }

    /**
     * add bill
     */
    function addBill() {
        let category = $('#note_category').val();
        let name = $('#note_name').val();
        let price = $('#note_price').val();
        $('#spinner').css('display', 'flex');
        emergency(category, name, price)
    }

    /**
     * remove bill
     * @param {int} id
     * @param {int} category
     * @param {string} name
     * @param {int} price
     */
    function removeBill(id, category, name, price) {
        $.ajax({
            type: 'delete',
            url: '/bill/' + id,
            data: { category : category},
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
            success: function(data){
                checkCategory(category, data)
            }
        })
    }

    /**
     * store note
     */
    $('#save').on('click', function(e) {
        if (!validasiForm()) {
            e.preventDefault(); // Mencegah pengiriman form jika validasi gagal
        } else {
            $('#spinner').css('display', 'flex');
            $.post("{{ route('note.store')}}", $('form').serialize(), function(e) {
                $('#save').prop('disabled', true);
                $('#spinner').css('display', 'none');
                alert("invoice berhail dibuat");
                let pasienId;
                pasienId = e;
                $('#print').removeClass('d-none');
                $('#print').attr('href', "/pasien/" + pasienId);
            })
        }
    })

    /**
     * get sum HP
     */
    $('#pasien_out').on('change', function () {
        let star = $('#pasien_in').val();
        let end = $('#pasien_out').val();
        if (star && end) {
            let startDate = new Date(star);
            let endDate = new Date(end);
            let diffTime = Math.abs(endDate - startDate);
            let diffDays = Math.round(diffTime / (1000 * 60 * 60 * 24)); 
            $('#pasien_sum').val(diffDays);
        } else {
            $('#pasien_sum').val('');
        }

    })
    /**
     * validasi form
     * @returns {boolean}
     */ 
    function validasiForm() {
        let fields = [
            { id: '#pasien_nik', pesan: 'NIK pasien mohon diisi' },
            { id: '#pasien_name', pesan: 'Nama pasien mohon diisi' },
            { id: '#pasien_age', pesan: 'Umur pasien mohon diisi' },
            { id: '#pasien_address', pesan: 'Alamat pasien mohon diisi' },
            { id: '#pasien_status', pesan: 'Status pasien mohon dipilih', isSelect: true }, // Tambahkan flag isSelect
            { id: '#pasien_in', pesan: 'Tanggal Masuk mohon diisi' },
            { id: '#pasien_room', pesan: 'Ruangan pasien mohon diisi' },
            { id: '#pasien_diagnoses', pesan: 'Diagnosa pasien mohon diisi' }
        ];
    
        let errors = []; // Untuk menyimpan pesan error
        let fieldKosongPertama = null; // Untuk menyimpan field pertama yang kosong
        
        fields.forEach(field => {
        let element = $(field.id); // Ambil elemen dari DOM
        if (element.length === 0) {
        // Jika elemen tidak ditemukan, lewati validasi untuk field ini
        // console.log(`Element dengan ID ${field.id} tidak ditemukan di DOM.`);
        return;
        }
    
        let value = element.val(); // Ambil nilai dari elemen
        if (field.isSelect) {
        // Jika elemen adalah <select>, cek apakah nilai default (kosong) dipilih
        if (value === '' || value === null) {
        errors.push(field.pesan); // Tambahkan pesan error jika tidak ada pilihan
        element.addClass('is-invalid'); // Tandai select sebagai invalid
        if (!fieldKosongPertama) {
        fieldKosongPertama = field.id; // Simpan field pertama yang kosong
        }
        } else {
        element.removeClass('is-invalid'); // Hapus tanda invalid jika valid
        }
        } else {
        // Jika elemen adalah input, cek apakah kosong
        if (value === null || value === undefined || value.trim() === '') {
        errors.push(field.pesan); // Tambahkan pesan error jika field kosong
        element.addClass('is-invalid'); // Tandai field sebagai invalid
        if (!fieldKosongPertama) {
        fieldKosongPertama = field.id; // Simpan field pertama yang kosong
        }
        } else {
        element.removeClass('is-invalid'); // Hapus tanda invalid jika field terisi
        }
        }
        });
    
        if (errors.length > 0) {
        alert(errors.join('\n')); // Tampilkan semua pesan error dalam satu alert
        if (fieldKosongPertama) {
        $(fieldKosongPertama).focus(); // Fokuskan ke field pertama yang kosong
        }
        return false; // Mencegah pengiriman form jika ada error
        }
    
        return true; // Izinkan pengiriman form jika semua field valid
    }

    //search pasien
    $(document).ready(function() {
        $('#searchInput').on('input', function() {
            let searchTerm = $(this).val();
            $.ajax({
                url: "{{ route('note.search') }}",
                method: "GET",
                data: { search: searchTerm },
                success: function(data) {
                    // console.log(data);
                    // Update the dropdown with the search results
                    $('#searchResults').empty();
                    if (data.length > 0) {
                        data.forEach(function(item) {
                            $('#searchResults').append(
                                `<li><a class="dropdown-item" href="#"
                                    data-name="${item.pasien_name}"
                                    data-nik="${item.pasien_nik}" 
                                    data-age="${item.pasien_age}"
                                    data-address="${item.pasien_address}"
                                    data-status="${item.pasien_status}"
                                    data-room="${item.pasien_room}"
                                    data-in="${item.pasien_in}">${item.pasien_nomor}.${item.pasien_nik} - ${item.pasien_name}</a></li>`
                            );
                        });
                    } else {
                        $('#searchResults').append('<li><a class="dropdown-item" href="#">Tidak ada hasil</a></li>');
                    }
                    
                    // select pasien from dropdown
                    $('#searchResults a').on('click', function() {
                        $('#pasien_nik').val($(this).data('nik'));
                        $('#pasien_name').val($(this).data('name'));
                        $('#pasien_age').val($(this).data('age'));
                        $('#pasien_address').val($(this).data('address'));
                        $('#pasien_status').val($(this).data('status'));
                        $('#pasien_room').val($(this).data('room'));
                        $('#pasien_in').val($(this).data('in'));
                        $('#searchInput').val($(this).text());
                        $('#searchResults').empty(); // Clear results after selection
                    });
                }
            });
        });
    });
</script>
@endpush