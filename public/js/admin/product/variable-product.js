let formStoreVariebleProduct = document.querySelector('.form-store-variable-product')
let formsUpdateVariebleProduct = document.querySelectorAll('.form-update-variable-product')


function responseErrorInButton(btn)
{   
    btn.classList.remove('btn-primary')
    btn.classList.add('btn-danger')

    setTimeout(() => {
        btn.classList.remove('btn-danger')
        btn.classList.add('btn-primary')                
    }, 2000);
}

function responseSuccessInButton(btn)
{   
    btn.classList.remove('btn-primary')
    btn.classList.add('btn-success')

    setTimeout(() => {
        btn.classList.remove('btn-success')
        btn.classList.add('btn-primary')    
        location.reload()            
    }, 2000);
}



async function storeVariableProduct(e)
{
    e.preventDefault()
    let button = this.querySelector('.variable-product-create')
    let formData = new FormData(e.currentTarget)

    try {
        let result = await axios.post(button.dataset.url, formData)
        responseSuccessInButton(button)
        formStoreVariebleProduct.reset()
    } catch (error) {
        responseErrorInButton(button)
        console.log(new Error(error))
    }   

}

async function updateVariableProduct(e)
{
    e.preventDefault()
    let button = this.querySelector('.variable-product-update')
    let formData = new FormData(e.currentTarget)
    try {
        let result = await axios.post(button.dataset.url, formData)
        responseSuccessInButton(button)
    } catch (error) {
        responseErrorInButton(button)
        console.log(new Error(error))
    }   
}

async function destroyVariableProduct(e)
{
    e.preventDefault()
    let button = this
    
    try {
        await axios.delete(button.dataset.url)
        // remove form 
        button.classList.remove('btn-danger')
        button.classList.add('btn-success')

        setTimeout(() => {
            button.closest('form').remove()
        }, 3000);
        
    } catch (error) {
        responseErrorInButton(button)
        console.log(new Error(error))
    }  
}


/* form variable product create */
formStoreVariebleProduct.addEventListener('submit', storeVariableProduct)


formsUpdateVariebleProduct.forEach(formUpdateVariebleProduct => {
    formUpdateVariebleProduct.addEventListener('submit', updateVariableProduct)
})

let buttonsVariableProductsDestroy = document.querySelectorAll('.variable-product-destroy')


buttonsVariableProductsDestroy.forEach(buttonVariableProductsDestroy => {
    buttonVariableProductsDestroy.addEventListener('click', destroyVariableProduct)
});


let buttonsDestroyImgProduct = document.querySelectorAll('.destroyImgProduct')
function modalDestroy(e)
{
    e.preventDefault()

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
            elementDestroy(this)
        }
    })
}

function elementDestroy(elemet)
{
    axios.delete(elemet.dataset.url).then(r => {
        Swal.fire(
            'Eliminado!',
            '',
            'success'
        )
       
        elemet.parentElement.remove()
    }).catch(error => console.error(error))

}

buttonsDestroyImgProduct.forEach(buttonDestroyImgProduct => {
    buttonDestroyImgProduct.addEventListener('click', modalDestroy)
});

$(document).ready(function() {
    $('.select2').select2();
});