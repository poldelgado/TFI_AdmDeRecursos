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
        return PurchaseOrder::all();
    }

    public function map($model): array {
        return [
            $model->id,
            $model->date_order->format('d/m/Y H:i'),
            $model->product()->name,
            $model->provider()->name,
            $model->warranty_void,
            $model->total,
            $model->purchase_qualification()->status,
            $model->purchase_qualification()->delivery,
            $model->purchase_qualification()->warranty,
            $model->purchase_qualification()->average,
            $model->created_at->format('d/m/Y H:i'),
            $model->updated_at->format('d/m/Y H:i'),
        ];
    }
}
