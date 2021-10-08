let formulario = document.getElementById('formulario')
let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
let ordenCab = document.getElementById('ordenCab').value
let listadoDetalle = document.getElementById('listadoDetalle')
let edit = document.getElementById('edit')
let nuevo = document.getElementById('nuevo')

document.addEventListener('DOMContentLoaded', () => {

    function limpia() {
        formulario[0].value = ''
        formulario[1].value = ''
        formulario[2].value = ''
    }

    nuevo.addEventListener('click', () => {
        limpia()
        formulario.setAttribute('action', 'storeDet')
        formulario.setAttribute('method', 'Post')
        $("#statusForm").prop('checked', true);
        formulario[2].value = 'A'
    })

    $('#statusForm').click(function () {
        if (this.checked) {
            this.value = 'A'
        } else {
            this.value = 'I'
        }
    })

    $('.statusRead').click(function () {
        return false;
    })

    $(".edit").click(function (e) {

        let valores = [];

        formulario.setAttribute('action', 'updateDet')
        formulario.setAttribute('method', 'PUT')

        $(this).parents("tr").find(".edit, #producto, #cantidad, .statusRead").each(function () {
            if (this.getAttribute('class') == 'statusRead') {
                valores.push(this.value)

            } else {
                valores.push(this.textContent.trim())
            }

        });

        carga(valores)
    });

    function carga(valores) {

        // console.log(valores)
        formulario[0].value = valores[0]
        formulario[1].value = valores[1]

        formulario[2].value = valores[2]

        if (valores[3] == 'A') {
            // console.log(formulario[2])
            $("#statusForm").prop('checked', true);
            formulario[3].value = valores[3]
        } else {
            // console.log(formulario[2])
            $("#statusForm").prop('checked', false);
            formulario[3].value = valores[3]
        }

    }

    formulario.addEventListener('submit', async e => {
        e.preventDefault()
        let ruta = formulario.getAttribute('action')
        let method = formulario.getAttribute('method')

        datos = new FormData(formulario)

        let status = datos.get('status') == 'A' ? 'A' : 'I'

        let data = {
            orden: ruta == 'storeDet' ? ordenCab : datos.get('idDet'),
            producto_descripcion: datos.get('producto_descripcion'),
            cantidad: datos.get('cantidad'),
            status: status
        }

        let res = await fetch('http://127.0.0.1:8000/' + ruta, {

            method: method,
            mode: 'cors',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })

        let resp = await res.json()

        if (resp[1] == 'guardado') {
            listadoDetalles(resp[0])
        }


        $('#saveEdit').modal('hide');

    })

    function listadoDetalles(data) {

        let tr = document.createElement('tr')


        let td1 = document.createElement('td')
        let td2 = document.createElement('td')
        let td3 = document.createElement('td')
        let td4 = document.createElement('td')

        td1.innerHTML = ` <a href="" data-toggle="modal" data-target="#saveEdit"> ${data.id}</a> `
        tr.appendChild(td1)
        td2.textContent = data.producto_descripcion
        tr.appendChild(td2)
        td3.textContent = data.cantidad
        tr.appendChild(td3)
        td4.innerHTML =
            `<input type="checkbox" name="status" id="status" ${data.estado == 'A' ? 'checked' : null} >`
        tr.appendChild(td4)

        listadoDetalle.appendChild(tr)

    }



})
