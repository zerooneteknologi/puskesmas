<?php

namespace App\Imports;

use App\Models\Laboratory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class LaboratoriesImport implements
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
        $data = Laboratory::where(
            'laboratory_name',
            $row['nama_laboratorium']
        )->first();
        if (!$data) {
            return new Laboratory([
                'laboratory_name' => $row['nama_laboratorium'],
                'laboratory_price' => $row['harga'],
            ]);
        } else {
            return null; // Skip this row if you don't want to update
        }
    }
    /**
     * Specify the heading row number.
     *
     * @return int
     */
    public function headingRow(): int
    {
        return 1; // Assuming the first row contains the headings
    }
    /**
     * Get the batch size for the import.
     *
     * @return int
     */
    public function batchSize(): int
    {
        return 1000; // Adjust the batch size as needed
    }
    /**
     * Get the chunk size for the import.
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000; // Adjust the chunk size as needed
    }
}
