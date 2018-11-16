<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithMapping, ShouldAutoSize {

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        return Product::all();
    }

    public function map($model): array {
        return [
            $model->id,
            $model->name,
            $model->description,
            $model->created_at->format('d/m/Y H:i'),
            $model->updated_at->format('d/m/Y H:i'),
        ];
    }
}
