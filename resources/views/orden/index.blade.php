@extends('layouts.app')

@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

    <div class="container mt-5">
        <table id="tabla" class="table table-striped mt-2">

            <form id="formulario" action=" {{ route('CrearOrden') }} " method="POST">
                @csrf
                <input type="checkbox" id="estado" name="estado" checked value="A" hidden>
                <button type="submit" class="btn btn-success">Crear</button>
            </form>

            <thead>
                <tr>
                    <th>Id</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody id="ordenes">

            </tbody>
        </table>

    </div>

    <script src="{{ asset('orden.js') }}"></script>

@endsection
