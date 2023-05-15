<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierProduct;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SupplierCatalogue implements WithStyles, WithHeadings, FromCollection
{
    public $supplierId;

    public function __construct($supplierId) {
       $this->supplierId = $supplierId;
    }

    /**
     * work sheet styles
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setVisible(false);
        $sheet->getColumnDimension('B')->setVisible(false);
    }
    /**
     * tamplate headings
     */
    public function headings(): array
    {
        return [
            'product_id',
            'supplier_id',
            'Supplier Name',
            'Product Name',
            'Product Code',
            'Available Quantity',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::all();

        $suppler = Supplier::find($this->supplierId);

        $array = [];

        foreach ($products as $product) {
            //get the code form the supplier product table
            $supplerProductCode = SupplierProduct::where('suplier_id', '=', $suppler->id)
                                                 ->where('product_id', '=', $product->id)
                                                 ->first();
            //create new array on each loop
            $newArr = [$product->id, $suppler->id, $suppler->name, $product->product_name, $supplerProductCode->suplier_product_code];

            array_push($array, $newArr);
        }

        return new Collection($array);
    }
}
