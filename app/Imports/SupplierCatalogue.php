<?php

namespace App\Imports;

use App\Models\SupplierProductCatalogue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SupplierCatalogue implements ToCollection, WithStartRow, WithChunkReading
{
    /**
     * ingnore the first row coz it has headings
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
        $catalogues = SupplierProductCatalogue::where('supplier_id', '=', $rows[0][1])->get();

        foreach ($catalogues as $item) {
            $item->delete();
        }

        foreach ($rows as $row) {
            SupplierProductCatalogue::create([
                'supplier_id' => $row[1],
                'product_id' => $row[0],
                'product_code' => $row[4],
                'available_amount' => $row[5]
            ]);
        }
    }
     /**
     * chunk the import so as to free memory
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}
