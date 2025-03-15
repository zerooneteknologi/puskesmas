@extends('layouts.main')
@section('title','Nota')

@section('content')

<div class="pagetitle">
    <h1>Nota Pembayaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Nota</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

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
</style>
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
                        <div class="row mb-3">
                            <label for="pasien_name" class="form-label col-md-4">Nama Pasien</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('pasien_name') is-invalid @enderror"
                                    id="pasien_name" name="pasien_name" required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                                @error('pasien_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pasien_age" class="form-label col-md-4">Usia Pasien</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('pasien_age') is-invalid @enderror"
                                    id="pasien_age" name="pasien_age" required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                                @error('pasien_age')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pasien_address" class="form-label col-md-4">Alamat Pasien</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('pasien_address') is-invalid @enderror"
                                    id="pasien_address" name="pasien_address" required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                                @error('pasien_address')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pasien_status" class="form-label col-md-4">Status Pasien</label>
                            <div class="col-md-8">
                                <select class="form-select" id="pasien_status" name="pasien_status" required>
                                    <option selected disabled value="">Pilih status</option>
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
                        <div class="row mb-3">
                            <label for="pasien_in" class="form-label col-md-4">Tanggal Dirawat</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control @error('pasien_in') is-invalid @enderror"
                                    id="pasien_in" name="pasien_in" required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                                @error('pasien_in')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pasien_out" class="form-label col-md-4">Tanggal Keluar</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control @error('pasien_out') is-invalid @enderror"
                                    id="pasien_out" name="pasien_out" required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                                @error('pasien_out')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pasien_sum" class="form-label col-md-4">Jumlah HP</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('pasien_sum') is-invalid @enderror"
                                    id="pasien_sum" name="pasien_sum" required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                                @error('pasien_sum')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pasien_room" class="form-label col-md-4">Ruangan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('pasien_room') is-invalid @enderror"
                                    id="pasien_room" name="pasien_room" required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                                @error('pasien_room')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pasien_diagnoses" class="form-label col-md-4">Diagnosa</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('pasien_diagnoses') is-invalid @enderror"
                                    id="pasien_diagnoses" name="pasien_diagnoses" required>
                                <span class="invalid-feedback">Mohon Diisi</span>
                                @error('pasien_diagnoses')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

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

        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title">Tindakan</h5>
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
    <div class="modal-dialog modal-dialog-centered">
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
                            <input type="number" class="form-control" id="note_price" name="price" required>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addBill()">Tambahkan</button>
                </div>
            </form><!-- End General Form Elements -->
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    /**
    * show modal create
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
    }
    
    function emergency(category, name, price) {
        $.ajax({
            type: 'post',
            url: "{{ route('bill.store')}}",
            data: { category : category, 
                    name : name, 
                    price: price
                    },
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
            success: function(data){
                checkCategory(category, data)
            }
        })
    }

    function addBill() {
        let category = $('#note_category').val();
        let name = $('#note_name').val();
        let price = $('#note_price').val();
        emergency(category, name, price)
    }

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

    $('#save').on('click', function() {
        $('#spinner').css('display', 'flex');
        $.post("{{ route('note.store')}}", $('form').serialize(), function() {
            $('#save').prop('disabled', true);
            $('#spinner').css('display', 'none');
            alert("invoice berhail dibuat");
        })
    })
</script>
@endpush