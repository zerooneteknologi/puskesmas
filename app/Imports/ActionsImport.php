<?php

namespace App\Imports;

use App\Models\Action;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ActionsImport implements
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
        $data = Action::where('action_name', $row['tindakan'])
            ->where('action_category', $row['kategori'])
            ->first();

        if (!$data) {
            return new Action([
                'action_category' => $row['kategori'],
                'action_name' => $row['tindakan'],
                'action_price' => $row['harga'],
            ]);
        } else {
            return null;
        }
        return new Action([
            'action_category' => $row['kategori'],
            'action_name' => $row['tindakan'],
            'action_price' => $row['harga'],
        ]);
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
