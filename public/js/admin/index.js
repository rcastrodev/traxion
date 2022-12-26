let root = document.querySelector('meta[name="url"]')
if(root)
    root = root.getAttribute('content')

function modalDestroy(id)
{
    Swal.fire({
        title: 'Deseas eliminar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Si!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            elementDestroy(id)
        }
      })
}

function elementDestroy(id)
{
    axios.delete(`${root}/${id}`).then(r => {
        Swal.fire(
            'Eliminado!',
            '',
            'success'
        )

        if(typeof table !== 'undefined')    
            table.ajax.reload()
        
        if(typeof tableService !== 'undefined')    
            tableService.ajax.reload()
        
    }).catch(error => console.error(error))

}

function renderImage(form, formdata){

    let file = formdata.get('image')
    let img = URL.createObjectURL(file)
    let attrImg = form.querySelector('img') 

    if(attrImg)
        attrImg.setAttribute('src', img)
}

function responseSuccessMessage(form){
    let button = form.querySelector('button[type="submit"]')
    button.classList.remove('btn-primary')
    button.classList.add('btn-success')
    button.textContent = 'sección actualizada'

    setTimeout(() => {
        button.classList.remove('btn-success')
        button.classList.add('btn-primary')
        button.textContent = 'Actualizar'
    }, 2000);
}

function responseErrorMessage(form)
{
    let button = form.querySelector('button[type="submit"]')
    button.classList.remove('btn-primary')
    button.classList.add('btn-danger')
    button.textContent = 'Error al actualizar'

    setTimeout(() => {
        button.classList.remove('btn-danger')
        button.classList.add('btn-primary')
        button.textContent = 'Actualizar'
    }, 2000);
}

function resetForm(form)
{
    if(form.dataset.info == 'reset'){
        setTimeout(() => {
            form.reset()
            let attrImg = form.querySelector('img')
            if(attrImg)
                attrImg.setAttribute('src', '')
        }, 3000);
    }
        
}

function responseValidationMessage(errors, form)
{
    let contentMessage = document.createElement('div')
    contentMessage.classList.add('alert', 'alert-danger', 'alert-dismissible', 'fade', 'show', 'my-3', 'col-sm-12')
    contentMessage.setAttribute('role', 'alert')

    for (const property in errors) {
        let span = document.createElement('li')
        span.textContent = errors[property]
        span.classList.add('d-block')
        contentMessage.appendChild(span)
    }

    let button = document.createElement('button')
    button.setAttribute('type', 'button')
    button.setAttribute('data-dismiss', 'alert')
    button.setAttribute('aria-label', 'Close')
    button.classList.add('close')

    let span = document.createElement('span')
    span.setAttribute('aria-hidden', 'true')
    span.textContent = 'x'


    button.appendChild(span)
    contentMessage.appendChild(button)

    form.insertBefore(contentMessage, form.firstChild)

    setTimeout(() => {
        form.querySelector('.alert-danger').remove()
    }, 5000);
}

async function findContent(id)
{   
    // get content 
    let url = document.querySelector('meta[name="content_find"]').getAttribute('content')
    if(url){
        if(id){
            try {
                let result = await axios.get(`${url}/${id}`)
                let content = result.data.content 
                dataSliderContent(content)
            } catch (error) {
                console.log(new Error(error));
            }
        }
    }
}


let forms = document.querySelectorAll('form')
forms.forEach(form => {
    form.addEventListener('submit', function(e){
        let form = e.currentTarget
        // bloquear el async
        if(form.dataset.sync == "no") return undefined
        e.preventDefault()

        let formData = new FormData(form)
        axios.post(form.getAttribute('action'), formData).then(r => {
            responseSuccessMessage(form)

            hasImg = formData.get('image')
            if(hasImg)
                if(hasImg.size)
                    renderImage(form, formData)

            if(typeof table !== 'undefined')    
                table.ajax.reload()

            if(typeof tableService !== 'undefined')    
                tableService.ajax.reload()
                    
            resetForm(form)
            
        }).catch(error =>{
            responseErrorMessage(form)
            if(error.response){
                if(error.response.status == 422)
                    responseValidationMessage(error.response.data.errors, form)
                
            }    
        })
    })
})

