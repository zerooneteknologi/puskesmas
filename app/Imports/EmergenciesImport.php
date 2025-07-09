<?php

namespace App\Imports;

use App\Models\Emergency;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EmergenciesImport implements
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
        $data = Emergency::where('emergency_name', $row['nama_ugd'])->first();
        if (!$data) {
            return new Emergency([
                'emergency_name' => $row['nama_ugd'],
                'emergency_price' => $row['harga'],
            ]);
        } else {
            return null; // Skip this row if you don't want to update
        }
    }
    /**
     * @return string
     */
    public function headingRow(): int
    {
        return 1; // Assuming the first row contains the headings
    }
    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000; // Adjust the batch size as needed
    }
    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000; // Adjust the chunk size as needed
    }
}
