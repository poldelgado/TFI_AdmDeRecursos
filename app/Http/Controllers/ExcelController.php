<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Exports\ProvidersExport;
use App\Exports\PurchaseOrdersExport;
use App\Exports\TechniciansExport;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use  Maatwebsite\Excel\Facades\Excel; // Excel namespace

use App\Exports\UsersExport;

class ExcelController extends Controller {

    public function exportUsers() {
        return Excel::download(new UsersExport(), 'usuarios.xlsx');
    }

    public function exportProviders() {
        return Excel::download(new ProvidersExport(), 'proveedores.xlsx');
    }

    public function exportPurchaseOrders() {
        return Excel::download(new PurchaseOrdersExport(), 'compras.xlsx');
    }

    public function exportProducts() {
        return Excel::download(new ProductsExport(), 'productos.xlsx');
    }

    public function exportTechnicians() {
        return Excel::download(new TechniciansExport(), 'tecnicos.xlsx');
    }
}
