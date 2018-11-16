<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithMapping, ShouldAutoSize {

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        return User::all();
    }

    public function map($model): array {
        return [
            $model->id,
            $model->name,
            $model->email,
            $model->admin == true ? 'admin' : 'usuario',
            $model->created_at->format('d/m/Y H:i'),
            $model->updated_at->format('d/m/Y H:i'),
        ];
    }
}
