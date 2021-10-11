
let formulario = document.getElementById('formulario')
let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
let ordenes = document.getElementById('ordenes')


document.addEventListener('DOMContentLoaded', () => {
    data()
})

const data = async () => {
    try {
        const res = await fetch('http://127.0.0.1:8000/data')
        const json = await res.json()
        append(json)
        // console.log(data)
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

        td1.innerHTML = ` <a href="http://127.0.0.1:8000/ordenDet/${element.id}">Orden # ${element.id} </a> `
        td2.innerHTML = ` <input type="checkbox" name="status" class="status" ${element.estado == 'A' ? 'checked' : null} > `
        tr.appendChild(td1)
        tr.appendChild(td2)
        fragment.appendChild(tr)
    });

    ordenes.appendChild(fragment)

    estadoBlock()
}

const estadoBlock = () => {

    $('.status').click(function () {
        return false;
    })

}

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
    append([resp])

})

