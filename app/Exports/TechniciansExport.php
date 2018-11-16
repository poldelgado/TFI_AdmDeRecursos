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
            $model->created_at->format('d/m/Y H:i'),
            $model->updated_at->format('d/m/Y H:i'),
        ];
    }
}
