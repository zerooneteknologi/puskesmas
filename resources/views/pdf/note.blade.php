<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Biaya Perawatan</title>
    <style>
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

        .patient-details,
        .billing-details {
            margin-bottom: 20px;
        }

        .patient-details table {
            width: 100%;
            border-collapse: collapse;
            /* Menghilangkan jarak antara border */
        }

        .patient-details th,
        .patient-details td {
            padding: 8px;
            text-align: left;
            border: none;
            /* Menghilangkan border */
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

        .footer {
            text-align: right;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>DINAS KESEHATAN KABUPATEN GARUT</h1>
        <h2>UPT PUSKESMAS CISURUPAN</h2>
        <p>Jl. Raya Cisurupan No. 27 Kecamatan Cisurupan Kabupaten Garut</p>
        <p>Email : blud.pkmcisurupan@gmail.com</p>
    </div>

    <div class="patient-details">
        <h3>Detail Pasien</h3>
        <table>
            <tr>
                <th>Nama Pasien:</th>
                <td>John Doe</td>
            </tr>
            <tr>
                <th>No. Rekam Medis:</th>
                <td>123456789</td>
            </tr>
            <tr>
                <th>Tanggal Perawatan:</th>
                <td>25 Oktober 2023</td>
            </tr>
            <tr>
                <th>Jenis Perawatan:</th>
                <td>Rawat Inap</td>
            </tr>
            <tr>
                <th>Alamat:</th>
                <td>Jl. Contoh No. 123, Garut</td>
            </tr>
            <tr>
                <th>No. Telepon:</th>
                <td>081234567890</td>
            </tr>
            <tr>
                <th>Dokter Penanggung Jawab:</th>
                <td>Dr. Jane Smith</td>
            </tr>
            <tr>
                <th>Ruangan:</th>
                <td>Ruang 101</td>
            </tr>
        </table>
    </div>

    <div class="billing-details">
        <h3>Rincian Biaya Perawatan</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Harga Satuan (Rp)</th>
                <th>Total (Rp)</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Kamar Rawat Inap</td>
                <td>3 Hari</td>
                <td>500.000</td>
                <td>1.500.000</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Obat-obatan</td>
                <td>10 Item</td>
                <td>50.000</td>
                <td>500.000</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Layanan Dokter</td>
                <td>2 Kali</td>
                <td>300.000</td>
                <td>600.000</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Layanan Lab</td>
                <td>5 Tes</td>
                <td>100.000</td>
                <td>500.000</td>
            </tr>
            <tr>
                <th colspan="4">Total Biaya</th>
                <td>3.100.000</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Garut, 25 Oktober 2023</p>
        <p>Petugas,</p>
        <br><br>
        <p>_________________________</p>
    </div>
</body>

</html>