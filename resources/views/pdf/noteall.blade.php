<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Biaya Perawatan</title>
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <style>
        hr.page-break {
            page-break-after: always;
            border: none;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            margin: 0;
        }

        .header h2 {
            font-size: 16px;
            margin: 0;
        }

        .header p {
            font-size: 12px;
            margin: 5px 0;
        }

        .patient-details {
            display: flex;
            /* Membuat dua tabel sejajar */
            gap: 20px;
            /* Jarak antara dua tabel */
            margin-bottom: 20px;
        }

        .patient-details table {
            width: 100%;
            /* Lebar tabel */
            border-collapse: collapse;
        }

        .patient-details th,
        .patient-details td {
            padding: 8px;
            text-align: left;
            border: none;
            /* Border tipis untuk kejelasan */
        }

        .billing-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .billing-details th,
        .billing-details td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .billing-details th {
            background-color: #f2f2f2;
        }

        #backToTopBtn {
            display: block;
            /* Tombol disembunyikan secara default */
            position: fixed;
            /* Tombol melayang */
            bottom: 20px;
            /* Jarak dari bawah */
            right: 20px;
            /* Jarak dari kanan */
            z-index: 99;
            /* Pastikan tombol di atas elemen lain */
            border: none;
            /* Hilangkan border */
            outline: none;
            /* Hilangkan outline */
            background-color: #007bff;
            /* Warna latar belakang */
            color: white;
            /* Warna teks */
            cursor: pointer;
            /* Ubah kursor saat diarahkan */
            padding: 15px;
            /* Padding */
            border-radius: 50%;
            /* Bentuk bulat */
            font-size: 18px;
            /* Ukuran teks */
            transition: background-color 0.3s;
            /* Animasi saat hover */
        }

        #backToTopBtn:hover {
            background-color: #0056b3;
            /* Warna latar belakang saat hover */
        }
    </style>
</head>

<body>
    <div class="page">
        @foreach ($pasiens as $pasien)
        <div class="header">
            <h1>DINAS KESEHATAN KABUPATEN GARUT</h1>
            <h2>UPT PUSKESMAS CISURUPAN</h2>
            <p>Jl. Raya Cisurupan No. 27 Kecamatan Cisurupan Kabupaten Garut</p>
            <p>Email : blud.pkmcisurupan@gmail.com</p>
        </div>

        @php
        $type = match (true) {
        str_starts_with($pasien->pasien_nomor, 'A') => 'rawat jalan',
        str_starts_with($pasien->pasien_nomor, 'B') => 'rawat inap',
        str_starts_with($pasien->pasien_nomor, 'C') => 'Poned',
        str_starts_with($pasien->pasien_nomor, 'D') => 'Ugd',
        str_starts_with($pasien->pasien_nomor, 'E') => 'PUSTU',
        default => '',
        };
        @endphp
        <h3 style="text-align: center">Rincian Biaya Perawatan {{ Str::title($type) }}</h3>
        <div class="patient-details">
            <!-- Tabel Pertama -->
            <table>
                <tr>
                    <th>Nomor</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_nomor }}</td>
                    <th>Tanggal Dirawat</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_in}}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_name }}</td>
                    <th>Tanggal Keluar</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_out}}</td>
                </tr>
                <tr>
                    <th>Umur</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_age}}</td>
                    <th>Jumlah HP</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_sum}}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_address}}</td>
                    <th>Ruangan</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_room}}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td style="width: 10%">:</td>
                    <td>@if ($pasien->pasien_status == 1)
                        Umum
                        @else
                        BPJS
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Diagnosa</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_diagnoses}}</td>
                </tr>
            </table>
        </div>

        <div class="billing-details">
            <table>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Tanggal</th>
                    <th>Rincian</th>
                    <th>Harga (Rp)</th>
                </tr>
                @php
                $groupNote = $pasien->notes->groupBy('note_category')
                @endphp

                @foreach ($groupNote as $category => $notes)

                <tr>
                    <th rowspan="{{ $notes->count() + 1}} " style="text-align: center">{{ $loop->iteration }}</th>
                    <th></th>
                    <th>
                        {{ [
                        1 => 'UGD',
                        2 => 'Perawatan',
                        3 => 'Laoratorium',
                        4 => 'Tindakan',
                        5 => 'Pemeriksaan Penunjang',
                        6 => 'Alat Kesehatan',
                        7 => 'Obat - Obatan',
                        8 => 'Tindakan Kebidanan',
                        9 => 'Tindakan Gigi'
                        ][$category] ?? '-' }}
                    </th>
                    <th style="text-align: right">{{ number_format($notes->sum('note_price'),0,",",".") }}</th>
                </tr>
                @foreach ($notes as $note)
                <tr>
                    <td>{{ $note->note_date }}</td>
                    <td>{{ $note->note_name}}</td>
                    <td style="text-align: right">{{ number_format($note->note_price, 0, ",",".") }}</td>
                </tr>
                @endforeach
                @endforeach
                <tr>
                    <th colspan="3" style="text-align: right;">Jumlah</th>
                    <th style="text-align: right;">{{ number_format($pasien->notes->sum('note_price'), 0, ",",".")}}
                    </th>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right">Diskon</td>
                    <td style="text-align: right">{{ number_format($pasien->pasien_discount, 0, ",",".")}}</td>
                </tr>
                @php
                $price = $pasien->notes->sum('note_price') - $pasien->pasien_discount;
                @endphp
                <tr>
                    <th colspan="3" style="text-align: right">Total</th>
                    <th style="text-align: right;">{{ number_format($price, 0, ",",".") }}</th>
                </tr>
            </table>
        </div>

        <div class="patient-details">
            <!-- Tabel Pertama -->
            @php
            $signatur = getSignatur();
            @endphp
            <table>
                <tr>
                    <td>
                        <p style="text-align: center">Petugas,</p>
                        <div style="margin-bottom: 60px"></div>
                        <p style="text-align: center">(_________________________)</p>
                    </td>
                    <td>
                        <p style="text-align: center">Keluarga Pasien</p>
                        <div style="margin-bottom: 60px"></div>
                        <p style="text-align: center">(_________________________)</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p style="text-align: center; margin: 0; padding: 0;">Mengetahui,</p>
                        <p style="text-align: center; margin: 0; padding: 0;">Kepala/Dokter Pemeriksa</p>
                        <p style="text-align: center; margin: 0; padding: 0;">UPT Puskesmas Cisurupan</p>
                        <div style="margin-bottom: 60px"></div>
                        <p style="text-align: center; margin: 0; padding: 0;">( <b>{{
                                $signatur['personnel_director']}}</b> )</p>
                        <p style="text-align: center; margin: 0; padding: 0;">NIP : {{ $signatur['personnel_nip']}}</p>
                    </td>
                </tr>
            </table>
        </div>

        <hr class="page-break">

        <div class="patient-details">
            <table>
                <tr>
                    <td>
                        <img src="/assets/img/garut.png" alt="Logo Garut" style="width: 2cm">
                    </td>
                    <td style="text-align: center; line-height: 1.2">
                        <h2 style="font-size: 14pt; margin: 0; padding: 0;">DINAS KESEHATAN KABUPATEN GARUT</h2>
                        <h2 style="font-size: 18pt; margin: 0; padding: 0;">UPT PUSKESMAS CISURUPAN</h2>
                        <p style="font-size: 12pt; margin: 0; padding: 0;">Jl. Raya Cisurupan No. 27 Kecamatan Cisurupan
                            Kabupaten Garut</p>
                        <p style="font-size: 12pt; margin: 0; padding: 0;">Email : blud.pkmcisurupan@gmail.com</p>
                    </td>
                    <td>
                        <img src="/assets/img/puskesmas.png" alt="Logo Puskesmas" style="width: 2cm">
                    </td>
                </tr>
            </table>
        </div>

        <!-- Garis pemisah ganda setelah content -->
        <div class="divider">
            <div class="thick-line"></div>
            <div class="thin-line"></div>
        </div>

        <h2 style="text-align: center">KWITANSI PEMBAYARAN PELAYANAN PASIEN {{ Str::upper($type) }}</h2>
        <div class="patient-details">
            <!-- Tabel Pertama -->
            <table>
                <tr>
                    <th>Nomor</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_nomor }}</td>
                    <th>Tanggal Masuk</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_in}}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_name }}</td>
                    <th>Tanggal Keluar</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_out}}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_address}}</td>
                    <th>Ruangan</th>
                    <td style="width: 10%">:</td>
                    <td>{{ $pasien->pasien_room}}</td>
                </tr>
            </table>
        </div>

        <div class="billing-details">
            <table>
                <tr>
                    <th colspan="3" style="text-align: center">Rincian Biaya (Rp)</th>
                </tr>
                @php
                $groupNote = $pasien->notes->groupBy('note_category')
                @endphp

                @foreach ($groupNote as $category => $notes)

                <tr>
                    <td style="width: 5%">{{ $loop->iteration }}</td>
                    <td>
                        {{ [
                        1 => 'UGD',
                        2 => 'Perawatan',
                        3 => 'Laoratorium',
                        4 => 'Tindakan',
                        5 => 'Pemeriksaan Penunjang',
                        6 => 'Alat Kesehatan',
                        7 => 'Obat - Obatan',
                        8 => 'Tindakan Kebidanan'
                        ][$category] ?? '-' }}
                    </td>
                    <td style="text-align: right">{{ number_format($notes->sum('note_price'), 0, ",", ".") }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="2" style="text-align: right">Jumlah</th>
                    <th style="text-align: right">{{ number_format($pasien->notes->sum('note_price'), 0, ",", ".")}}
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right">Diskon</td>
                    <td style="text-align: right">{{ number_format($pasien->pasien_discount, 0, ",",".")}}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right">Total</td>
                    <th style="text-align: right">{{ number_format($price, 0, ",",".") }}</th>
                </tr>
                <tr>
                    <th style="border: none">Terbilang</th>
                    <th style="border: none" colspan="2"><em>{{ terbilang($price)}} rupiah</em></th>
                </tr>
            </table>
        </div>

        <div class="patient-details">
            <!-- Tabel Pertama -->
            <table>
                <tr>
                    <td>
                        <p style="text-align: center">Penerima,</p>
                        <div style="margin-bottom: 60px"></div>
                        <p style="text-align: center">(_________________________)</p>
                    </td>
                    <td>
                        <p style="text-align: center">Bendahara,</p>
                        <div style="margin-bottom: 60px"></div>
                        <p style="text-align: center">( <b>{{ $signatur['personnel_treasurer']}}</b> )</p>
                    </td>
                </tr>
            </table>
        </div>

        <hr class="page-break">
        @endforeach
    </div>

    <button id="backToTopBtn" title="print"><i class="bi bi-printer"></i></button>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="/assets/js/printThis.js"></script>

    <script>
        $('#backToTopBtn').on('click', function(){
            $('.page').printThis();
        })
    </script>

</body>

</html>