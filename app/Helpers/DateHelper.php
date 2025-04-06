<?php

// app/Helpers/DateHelper.php
if (!function_exists('formatTanggalIndonesia')) {
    function formatTanggalIndonesia($date)
    {
        $hari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $bulan = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        $carbonDate = \Carbon\Carbon::parse($date);
        $dayName = $hari[$carbonDate->format('l')];
        $monthName = $bulan[$carbonDate->format('F')];

        return $dayName .
            ', ' .
            $carbonDate->format('d') .
            ' ' .
            $monthName .
            ' ' .
            $carbonDate->format('Y');
    }
}
