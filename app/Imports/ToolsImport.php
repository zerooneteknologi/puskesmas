<?php

namespace App\Imports;

use App\Models\Tool;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ToolsImport implements
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
        $data = Tool::where('tool_name', $row['nama_peralatan'])->first();
        if (!$data) {
            return new Tool([
                'tool_name' => $row['nama_peralatan'],
                'tool_price' => $row['harga'],
            ]);
        } else {
            return null; // Skip if the tool already exists
        }

        return new Tool([
            'tool_name' => $row['nama_peralatan'],
            'tool_price' => $row['harga'],
        ]);
    }
    /**
     * @return string
     */
    public function headingRow(): int
    {
        return 1;
    }
    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }
    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}
