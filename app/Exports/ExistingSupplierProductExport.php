<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierProduct;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExistingSupplierProductExport implements WithHeadings, FromCollection, WithStyles
{
    public $supplierId;

    public function __construct($supplierId) {
        $this->supplierId = $supplierId;
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

    public function collection()
    {
        $sId = Supplier::where('id','=',$this->supplierId)->first();

        $supplierProducts = SupplierProduct::where('suplier_id','=',$sId->id)->get();

        $arr = [];

        foreach ($supplierProducts as $supplierProduct) {
            $newArr = [];
            $product = Product::where('id','=', $supplierProduct->product_id)->first();
            $newArr = [$sId->id, $sId->name, $product->id, $product->product_name, $supplierProduct->suplier_product_code, $supplierProduct->product_price];
            array_push($arr, $newArr);
        }
        return new Collection($arr);
    }
}
