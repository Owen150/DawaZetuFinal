<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SupplierProductExport implements FromCollection, WithHeadings, WithStyles
{

    public $supplierId;

    public $supplierName;

    public function __construct($supplierId, $supplierName) {
        $this->supplierId = $supplierId;
        $this->supplierName = $supplierName;
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setVisible(false);
        $sheet->getColumnDimension('C')->setVisible(false);
    }
    
    /**
     * tamplate headings
     */
    public function headings(): array
    {
        return [
            'supplier_id',
            'supplier_name',
            'product_id',
            'product_name',
            'product_code',
            'price'
        ];
    }

    /**
     * tamplate data
     */
    public function collection()
    {

        $products = Product::all();

        $arr = [];

        for ($i=0; $i  < count($products); $i++) { 
            //create new array on each loop
            $newArr = [];

            //add supplier_id and product_id to the new array
            $newArr = [$this->supplierId, $this->supplierName, $products[$i]->id, $products[$i]->product_name];

            //array_push($newArr, $suppliers[$i]->id);

            //push the new array to $arr coz we need inner arrays to be rows
            array_push($arr, $newArr);
        }

        return new Collection($arr);
    }
   
}
