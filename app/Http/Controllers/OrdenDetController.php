<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\OrdenDet;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\DataCollector\AjaxDataCollector;

class OrdenDetController extends Controller
{
    public function index($id)
    {
        $ordenes = OrdenDet::where('orden_id', $id)
            ->where('estado', 'A')
            ->get();

        return view('orden.listadoorden', compact('ordenes', 'id'));
    }

    public function dataOrdenDet($id)
    {

        $ordenes = OrdenDet::where('orden_id', $id)
            ->where('estado', 'A')
            ->get();
        // $data = [$ordenes, $id];
        return json_encode($ordenes);

    }

    public function store(Request $request)
    {

        $ordenes = new OrdenDet;
        $ordenes->orden_id = intval($request->get('orden'));
        $ordenes->producto_descripcion = $request->get('producto_descripcion');
        $ordenes->cantidad = intval($request->get('cantidad'));
        $ordenes->estado = $request->get('status');
        $ordenes->save();
        return json_encode([$ordenes, 'guardado']);

    }

    public function update(Request $request)
    {

        $id = intval($request->get('orden'));
        $ordenes = OrdenDet::find($id);
        $ordenes->producto_descripcion = $request->get('producto_descripcion');
        $ordenes->cantidad = intval($request->get('cantidad'));
        $ordenes->estado = $request->get('status');
        $ordenes->save();
        return json_encode([$ordenes, 'actualizado']);
    }
}
