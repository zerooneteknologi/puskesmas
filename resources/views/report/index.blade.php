@extends('layouts.main')
@section('title','DAFTAR Note Pasien')

@section('content')

<div class="pagetitle">
    <h1>Laporan Nota pasien</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Laporan Nota Pasien</li>
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

            @php
            $unitTitles = [
            'a' => 'Laporan Nota Rawat Jalan',
            'b' => 'Laporan Nota Pasien Rawat Inap',
            'c' => 'Laporan Nota Pasien PONED',
            'd' => 'Laporan Nota Pasien UGD',
            ];
            @endphp

            @if(isset($unitTitles[request('unit')]))
            <h5 class="card-title">{{ $unitTitles[request('unit')] }}</h5>
            @endif

            <form action="" method="GET" id="form">
                @csrf
                <div class="row mt-3">
                    <label for="filter" class="form-label col-md-2"><i class="bi bi-filter"></i> Filter</label>
                    <div class="col-md-6 row" id="filterMonth">
                        <label for="month" class="form-label col-md-4">Pilih Bulan</label>
                        <div class="col-md-8">
                            <input type="month" name="month" id="month" class="form-control"
                                value="{{ request('month') }}">
                        </div>
                    </div>
                </div>
            </form>


        </div>

        <div id="noteTable" class="table-responsive">
        </div>

        {{-- Table for displaying notes --}}
        <!-- Table with stripped rows -->
        {{-- <table class="table datatable table-hover" id="noteTable">
        </table> --}}
        <!-- End Table with stripped rows -->


    </div>
    </div>
</section>

@endsection

@push('script')
<script>
    // filter date action
    $('#form').on('change', 'input, select', function() {
        // console.log($(this).val());
        filterForm();
    });

    // Initialize DataTable
    $(document).ready(function() {
        filterForm()
    });

    // filter form submission
    function filterForm(){

        $.ajax({
            url: "{{ route('report.create') }}?unit=" + "{{ request('unit') }}",
            data: $('#form').serialize(),
            success: function(data) {
                // console.log(data);
                
            $('#noteTable').html(data);
            },
            error: function(xhr) {
            $('#noteTable').html('<div class="alert alert-danger">Terjadi kesalahan saat memuat data.</div>');
            }
        });
    }
</script>
@endpush