<?php

namespace App\Imports;

use App\Models\SupplierProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SupplierProductImport implements ToCollection, WithChunkReading, WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        
        foreach ($rows as $row) 
        {
            
            SupplierProduct::create([
                'suplier_id' => $row[0],
                'product_id' => $row[2],
                'suplier_product_code' => $row[4],
                'product_price' => $row[5],
            ]);
        }
    }
    /**
     * chunk the import so as to free memory
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}
