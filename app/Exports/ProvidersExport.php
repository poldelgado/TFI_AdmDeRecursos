<?php

namespace App\Exports;

use App\Provider;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProvidersExport implements FromCollection, WithMapping, ShouldAutoSize {

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        return Provider::all();
    }

    public function map($model): array {
        return [
            $model->id,
            $model->cuit,
            $model->name,
            $model->email,
            $model->phone,
            $model->address,
            $model->created_at->format('d/m/Y H:i'),
            $model->updated_at->format('d/m/Y H:i'),
        ];
    }
}
