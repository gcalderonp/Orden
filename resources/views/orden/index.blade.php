@extends('layouts.app')

@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

    <div class="container mt-5">

        <table class="table table-striped mt-2">

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

                @foreach ($ordenes as $orden)

                    <tr>
                        <td scope="row"> <a href=" {{ route('ordenDet', $orden) }} ">Orden # {{ $orden->id }}</a> </td>
                        <td> <input type="checkbox" name="status" class="status" @if ($orden->estado == 'A') checked > @endif </td>
                    </tr>

                @endforeach

            </tbody>
        </table>

    </div>

    <script>
        let formulario = document.getElementById('formulario')
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        // let ordenes = document.getElementById('ordenes')


        document.addEventListener('DOMContentLoaded', () => {
            $('.status').click(function() {
                return false;
            })
        })

        formulario.addEventListener('submit', async e => {
            e.preventDefault()

            let status = document.getElementById('estado').value

            let data = {
                status: status
            }

            const res = await fetch('http://127.0.0.1:8000/CrearOrden', {
                method: 'Post',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })

            const resp = await res.json()
            console.log(resp)
            append(resp)

        })

        function append(data) {

            let ordenes = document.getElementById('ordenes')
            let tr = document.createElement('tr')
            let td1 = document.createElement('td')
            let td2 = document.createElement('td')

            td1.innerHTML = `<a href=" {{ route('ordenDet', $orden) }} ">Orden # ${data.id}</a>`
            tr.appendChild(td1)

            td2.innerHTML = ` <input type="checkbox" name="status" class="status" ${ data.estado == 'A'? 'checked' : null } > `
            tr.appendChild(td2)

            ordenes.appendChild(tr)

        }
    </script>

@endsection
