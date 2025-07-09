<?php

namespace App\Imports;

use App\Models\Medicine;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MedicinesImport implements
    ToModel,
    WithHeadingRow,
    WithBatchInserts,
    WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $data = Medicine::where('medicine_name', $row['nama_obat'])->first();

        if (!$data) {
            return new Medicine([
                'medicine_name' => $row['nama_obat'],
                'medicine_price' => $row['harga'],
            ]);
        } else {
            return null; // Skip if the medicine already exists
        }
    }
    /**
     * Define the heading row number.
     *
     * @return int
     */
    public function headingRow(): int
    {
        return 1; // Assuming the first row contains the headings
    }
    /**
     * Get the batch size for batch inserts.
     *
     * @return int
     */
    public function batchSize(): int
    {
        return 1000; // Adjust the batch size as needed
    }
    /**
     * Get the chunk size for chunk reading.
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000; // Adjust the chunk size as needed
    }
}
