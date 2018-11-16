<?php

namespace App\Exports;

use App\PurchaseOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class PurchaseOrdersExport implements FromCollection, WithMapping, ShouldAutoSize {

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        return PurchaseOrder::with('product')->get();
    }

    public function map($model): array {
        return [
            $model->id,
            $model->date_order->format('d/m/Y H:i'),
            $model->product->name,
            $model->provider->name,
            $model->warranty_void,
            round($model->total,2),
            isset($model->purchase_qualification_id) ? $model->purchase_qualification->status : null,
            isset($model->purchase_qualification_id) ? $model->purchase_qualification->delivery : null,
            isset($model->purchase_qualification_id) ? $model->purchase_qualification->warranty : null,
            isset($model->purchase_qualification_id) ? $model->purchase_qualification->average : null,
            isset($model->created_at) ? $model->created_at->format('d/m/Y H:i') : '',
            isset($model->updated_at) ? $model->updated_at->format('d/m/Y H:i') : '',
        ];
    }
}
