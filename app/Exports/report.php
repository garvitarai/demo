<?php

namespace App\Exports;
use App\compProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;


class report implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
     return(compProduct::select('compProducts.store', 'compProducts.description',
  	 'compProducts.regularPrice', 'compProducts.internalPrice', DB::raw('((regularPrice - internalPrice) / regularPrice)'), 'compProducts.salePrice', DB::raw('((salePrice - internalPrice) / salePrice)')));    }

  	public function headings(): array
    {
        return [
            'Store',
            'Description',
            'Regular Price',
            'TJX Price',
            '% WMI Discount',
            'Sale Price',
            '% WMI Sale Discount',
        ];
    }
}