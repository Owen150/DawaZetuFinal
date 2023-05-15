<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierProductCatalogue;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SupplierExistingCatalogue implements FromCollection, WithHeadings, WithStyles
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
        $suppler = Supplier::find($this->supplierId);

        $catalogueProducts = SupplierProductCatalogue::where('supplier_id','=', $suppler->id)->get();

        $array = [];

        foreach ($catalogueProducts as $catalogueProduct) {
            //find the product
            $product = Product::find($catalogueProduct->product_id);
            //array to store the values
            $newArray = [$catalogueProduct->product_id, $suppler->id,$suppler->name, $product->product_name, $catalogueProduct->product_code, $catalogueProduct->available_amount];
            //add the newArray to array
            array_push($array, $newArray);
        }

        return new Collection($array);
    }
}
