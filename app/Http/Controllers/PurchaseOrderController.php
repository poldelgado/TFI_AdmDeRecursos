<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\PurchaseQualification;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $purchaseOrders = PurchaseOrder::all();
        $purchaseOrdersComplete = [];
        foreach ($purchaseOrders as $purchaseOrder) {
            $purchaseOrdersComplete[] = [
                "id" => $purchaseOrder->id,
                "total" => $purchaseOrder->total,
                "date_order" => $purchaseOrder->date_order->format("Y-m-d"),
                "qualification" => $purchaseOrder->purchase_qualification_id !== null ? $purchaseOrder->purchase_qualification->average : null,
                "product_id" => $purchaseOrder->product_id,
                "provider_id" => $purchaseOrder->provider_id,
				"product" => $purchaseOrder->product_id !== null ? $purchaseOrder->product->name : null,
                "provider" => $purchaseOrder->product_id !== null ? $purchaseOrder->provider->name : null,
                "warranty_void" => $purchaseOrder->warranty_void,
            ];
        }
        return $this->renderJson(true, $purchaseOrdersComplete, 'Listado de Órdenes de Compra');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSinCalificar() {
        $purchaseOrders = PurchaseOrder::leftJoin('purhcase_orders', function($join) {
            $join->on('purchase_orders.id', '=', 'purchase_qualifications.id');
        })
            ->whereNull('purchase_qualifications.id')
            ->get();
        $purchaseOrdersComplete = [];
        foreach ($purchaseOrders as $purchaseOrder) {
            $purchaseOrdersComplete[] = [
                "id" => $purchaseOrder->id,
                "total" => $purchaseOrder->total,
                "date_order" => $purchaseOrder->date_order,
//                "qualification" => $purchaseOrder->purchase_qualification_id !== null ? $purchaseOrder->purchase_qualification->average : null,
                "product" => $purchaseOrder->product_id !== null ? $purchaseOrder->product->name : null,
                "provider" => $purchaseOrder->product_id !== null ? $purchaseOrder->provider->name : null,
                "warranty_void" => $purchaseOrder->warranty_void,
            ];
        }
        return $this->renderJson(true, $purchaseOrdersComplete, 'Listado de Órdenes de Compra');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'date_order' => 'required:date',
            'provider_id' => 'required',
            'product_id' => 'required',
            'warranty_void' => 'required:integercontro',
            'total' => 'required'
        ]);

        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->date_order = $request->date_order;
        $purchaseOrder->provider_id = $request->provider_id;
        $purchaseOrder->product_id = $request->product_id;
        $purchaseOrder->warranty_void = $request->warranty_void;
        $purchaseOrder->total = $request->total;
        $qualification = new PurchaseQualification();
        if ($qualification->save()) {
            $purchaseOrder->purchase_qualification()->associate($qualification);
            if ($purchaseOrder->save()) {
                return $this->renderJson(true, null, 'Orden de Compra registrada exitosamente');
            }
        }
        return $this->renderJson(false, null, 'Ocurrió un error al registrar la Orden de Compra');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $purchaseOrder = PurchaseOrder::find($id);

        if (isset($purchaseOrder)) {
            $purchaseOrderComplete = [
                "id" => $purchaseOrder->id,
                "total" => $purchaseOrder->total,
                "date_order" => $purchaseOrder->date_order,
                "qualification" => $purchaseOrder->purchase_qualification_id !== null ? $purchaseOrder->purchase_qualification->average : null,
                "product" => $purchaseOrder->product_id !== null ? $purchaseOrder->product->name : null,
                "provider" => $purchaseOrder->product_id !== null ? $purchaseOrder->provider->name : null,
                "warranty_void" => $purchaseOrder->warranty_void,
            ];
            return $this->renderJson(true, $purchaseOrderComplete, 'Orden de Compra');
        }
        return $this->renderJson(false, null, 'No existe el Orden de Compra buscado');
    }

    public function qualifyPurchaseOrder(Request $request) {
        $this->validate($request, [
            'purchase_order_id' => 'required|numeric',
            'purchase_qualification_delivery' => 'required|numeric',
            'purchase_qualification_status' => 'required|numeric',
            'purchase_qualification_warranty' => 'required|numeric',
        ]);

        $purchaseOrder = PurchaseOrder::find($request->purchase_order_id);
        if (isset($purchaseOrder)) {
            $qualification = new PurchaseQualification();
            $qualification->delivery = $request->purchase_qualification_delivery;
            $qualification->status = $request->purchase_qualification_status;
            $qualification->warranty = $request->purchase_qualification_warranty;
            $values = [$qualification->delivery, $qualification->status, $qualification->warranty];
            $qualification->average = (double) (array_sum($values) / count($values));
            if ($qualification->save()) {
                $purchaseOrder->purchase_qualification_id = $qualification->getKey();
                if ($purchaseOrder->save()) {
                    return $this->renderJson(true, null, 'La Orden de Compra se calificó correctamente');
                }
            }
            return $this->renderJson(false, null, 'Ocurrío un error al calificar la Orden de Compra');
        }
        return $this->renderJson(false, null, 'No existe la Orden de Compra');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateQualification(Request $request) {

        $this->validate($request, [
            'purchase_order_id' => 'required|numeric',
            'purchase_qualification_delivery' => 'required|numeric',
            'purchase_qualification_status' => 'required|numeric',
            'purchase_qualification_warranty' => 'required|numeric',
        ]);

        $purchaseOrder = PurchaseOrder::find($request->purchase_order_id);
        if (isset($purchaseOrder)) {
            if (isset($purchaseOrder->purchase_qualification_id)) {
                $qualification = PurchaseQualification::find($purchaseOrder->purchase_qualification_id);
            } else {
                $qualification = new PurchaseQualification();
            }

            $qualification->delivery = $request->purchase_qualification_delivery;
            $qualification->status = $request->purchase_qualification_status;
            $qualification->warranty = $request->purchase_qualification_warranty;
            $values = [$qualification->delivery, $qualification->status, $qualification->warranty];
            $qualification->average = (double) (array_sum($values) / count($values));
            if ($qualification->save()) {
                $purchaseOrder->purchase_qualification_id = $qualification->getKey();
                if ($purchaseOrder->save()) {
                    return $this->renderJson(true, null, 'La Orden de Compra se calificó correctamente');
                }
            }
            return $this->renderJson(false, null, 'Ocurrío un error al actualizar la calificación de la Orden de Compra');
        }
        return $this->renderJson(false, null, 'No existe la Orden de Compra');

    }
}
