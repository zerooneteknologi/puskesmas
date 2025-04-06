@extends('layouts.main')
@section('title','DASBOARD')

@section('content')

<div class="pagetitle">
    <h1>Home</h1>
    {{-- <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Home</li>
        </ol>
    </nav> --}}
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <div class="col-xxl-4 col-md-4">
            <!-- Customers Card -->
            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Jumlah Pasien <span>| Hari ini</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $pasienday }}</h6>

                        </div>
                    </div>

                </div>
            </div>
            <!-- End Customers Card -->
        </div>
        <div class="col-xxl-4 col-md-4">
            <!-- Customers Card -->
            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Jumlah Pasien <span>| Bulan ini</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $pasienmonth }}</h6>

                        </div>
                    </div>

                </div>
            </div>
            <!-- End Customers Card -->
        </div>
        <div class="col-xxl-4 col-md-4">
            <!-- Customers Card -->
            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Jumlah Pasien <span>| Tahun ini</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $pasiensum }}</h6>

                        </div>
                    </div>

                </div>
            </div>
            <!-- End Customers Card -->
        </div>

        <div class="col-12">
            <!-- Recent Sales -->
            <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <h5 class="card-title">Pasien terbaru</h5>

                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th scope="col">Nomor</th>
                                <th scope="col">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasiens as $pasien)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th scope="row"><a href="#">{{ $pasien->pasien_nomor}}</a></th>
                                <td>{{ $pasien->pasien_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
            <!-- End Recent Sales -->
        </div>
    </div>
</section>

@endsection