let formulario = document.getElementById('formulario')
let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
let ordenCab = document.getElementById('ordenCab').value
let listadoDetalle = document.getElementById('listadoDetalle')
let edit = document.getElementById('edit')
let nuevo = document.getElementById('nuevo')
let checkForm = document.getElementById('statusForm')



document.addEventListener('DOMContentLoaded', () => {

    CargaTabla()

    $('#statusForm').click(function () {
        if (this.checked) {
            this.value = 'A'
        } else {
            this.value = 'I'
        }
    })

})



const CargaTabla = async () => {

    try {

        const res = await fetch('http://127.0.0.1:8000/dataOrdenDet/' + ordenCab)
        const json = await res.json()
        append(json)
    } catch (error) {
        console.log(error)
    }

}

const append = json => {

    let fragment = document.createDocumentFragment()

    json.forEach(element => {
        let tr = document.createElement('tr')
        let td1 = document.createElement('td')
        let td2 = document.createElement('td')
        let td3 = document.createElement('td')
        let td4 = document.createElement('td')

        td2.setAttribute('class', 'producto')
        td3.setAttribute('class', 'cantidad')

        td1.innerHTML = ` <a class="edit" href="" data-toggle="modal" data-target="#saveEdit">${element.id}</a>  `
        td2.innerHTML = element.producto_descripcion
        td3.innerHTML = element.cantidad
        td4.innerHTML = ` <input type="checkbox" name="status" class="statusRead" value ="${element.estado}" ${element.estado == 'A' ? 'checked' : null} > `
        tr.appendChild(td1)
        tr.appendChild(td2)
        tr.appendChild(td3)
        tr.appendChild(td4)
        fragment.appendChild(tr)
    });


    listadoDetalle.appendChild(fragment)

    $(".edit").click(function (e) {

        $('#divStatus').show()

        let valores = [];

        formulario.setAttribute('action', 'updateDet')
        formulario.setAttribute('method', 'PUT')

        $(this).parents("tr").find(".edit, .producto, .cantidad, .statusRead").each(function () {

            if (this.getAttribute('class') == 'statusRead') {
                valores.push(this.value)

            } else {
                valores.push(this.textContent.trim())
            }

        });

        editar(valores)

    });

    $('.statusRead').click(function () {
        return false;
    })
}




function limpia() {
    formulario[0].value = ''
    formulario[1].value = ''
    formulario[2].value = ''
}



nuevo.addEventListener('click', () => {
    limpia()
    // checkForm.disabled = true
    formulario.setAttribute('action', 'storeDet')
    formulario.setAttribute('method', 'Post')
    $("#statusForm").prop('checked', true);
    formulario[3].value = 'A'
    $('#divStatus').hide()
    // checkForm.disabled = true
})


function editar(valores) {

    // $('#statusForm').click(function () {
    //     return true;
    // })

    formulario[0].value = valores[0]
    formulario[1].value = valores[1]

    formulario[2].value = valores[2]

    if (valores[3] == 'A') {
        $("#statusForm").prop('checked', true);
        formulario[3].value = valores[3]
    } else {
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
        append([resp[0]])
    } else if (resp[0].estado == 'I') {
        elimina(resp[0].id)
    } else {
        update(resp[0])
    }

    $('#saveEdit').modal('hide');

})


const update = (data) => {

    let number = 0
    for (let i = 0, row; row = listadoDetalle.rows[i]; i++) {
        number = parseInt(row.cells[0].textContent.trim())

        if (number == data.id) {

            for (let j = 1, cell; cell = row.cells[j]; j++) {

                if (j == 1) {
                    listadoDetalle.rows[i].cells[j].textContent = data.producto_descripcion
                } else if (j == 2) {
                    listadoDetalle.rows[i].cells[j].textContent = data.cantidad
                    return
                }

            }

        }

    }

}

const elimina = (id) => {

    let number = 0
    for (let i = 0, row; row = listadoDetalle.rows[i]; i++) {
        number = parseInt(row.cells[0].textContent.trim())

        if (number == id) {
            listadoDetalle.rows[i].remove()
            break
        }

    }

}







// document.getElementById('statusForm').addEventListener('click', () => {
//     if (this.checked) {
//         this.value = 'A'
//     } else {
//         this.value = 'I'
//     }
// })
