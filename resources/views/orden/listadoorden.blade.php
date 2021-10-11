@extends('layouts.app')

@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

    <div class="container mt-5">


        <div class="d-flex justify-content-between">
            <a id="nuevo" data-toggle="modal" data-target="#saveEdit" class="btn btn-success ml-3" href="#">Nuevo</a>
            <a class="btn btn-warning mr-3" href="{{ route('index') }}">Atras</a>
        </div>

        <input  type="text" name="ordenCab" id="ordenCab" value=" {{ $id }} " hidden>

        <table id="tabla" class="table table-striped mt-2">

            <thead>

                <tr>
                    <th>OrdenDetId</th>
                    <th>Producto_descripcion </th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody id="listadoDetalle">

            </tbody>
        </table>

    </div>





    <div class="modal fade" id="saveEdit" tabindex="-1" aria-labelledby="saveEdit" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saveEdit">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="formulario" action="">

                        <input type="text" name="idDet" id="idDet" hidden>

                        <div class="container">
                            <div class="row">
                                <div class="col-12">

                                    <div class="form-group">

                                        <label for="Producto_descripcion">Producto y Descripcion</label>
                                        <textarea name="producto_descripcion" id="producto_descripcion"
                                            class="form-control" rows="3"></textarea>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-6">

                                    <div class="form-group">

                                        <label for="cantidad">Cantidad</label>
                                        <input type="number" name="cantidad" id="cantidad" class="form-control">

                                    </div>

                                </div>

                                <div id="divStatus" class="col-6">

                                    <div class="form-check align-items-center">

                                        <input class="form-check-input" type="checkbox" value="A" name="status" checked
                                            id="statusForm">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Estado
                                        </label>

                                    </div>

                                </div>
                            </div>

                        </div>

                        <button id="button" type="submit" class="btn btn-success">Guardar</button>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('ordenDet.js') }}"></script>


@endsection
