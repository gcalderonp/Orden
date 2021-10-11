<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrdenController extends Controller
{
    public function index(){
        // $ordenes = Orden::all();
        return view('orden.index');
    }

    public function data(){
        $ordenes = Orden::all();
        return json_encode($ordenes);
    }

    public function store(Request $request){

        $ordenes = new Orden();

        $ordenes->estado = $request->get('status');
        $ordenes->save();

        return json_encode($ordenes);
    }

}
