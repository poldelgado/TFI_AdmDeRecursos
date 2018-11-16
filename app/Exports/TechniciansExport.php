<?php

namespace App\Exports;

use App\Technician;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class TechniciansExport implements FromCollection, WithMapping, ShouldAutoSize {

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        return Technician::all();
    }

    public function map($model): array {
        return [
            $model->id,
            $model->cuit,
            $model->last_name,
            $model->first_name,
            $model->phone,
            $model->email,
            $model->address,
            isset($model->created_at) ? $model->created_at->format('d/m/Y H:i') : '',
            isset($model->updated_at) ? $model->updated_at->format('d/m/Y H:i') : '',
        ];
    }
}
