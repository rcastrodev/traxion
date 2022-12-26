$('.toggle').click(function(e){
    e.preventDefault()
    $(this).siblings('ul').toggle();
})

let formActualizarCarrito = document.querySelector('.actualizar-carrito')
if (formActualizarCarrito) 
    formActualizarCarrito.addEventListener('submit', function(e){
        e.preventDefault()
        let form = e.currentTarget
        let button = form.querySelector('button')
        let formData = new FormData(form)

        axios.post(form.getAttribute('action'), formData)
            .then(r => {
                button.innerText = 'agregado'
                button.classList.remove('bg-yellow')
                button.classList.add('btn-success')
                setTimeout(() => {
                    button.innerText = 'agregar al carrito' 
                    button.classList.remove('btn-success')
                    button.classList.add('bg-yellow')
                }, 2000);
            })
            .catch(error => {
                console.error(error)
                button.innerText = 'error'
                button.classList.remove('bg-yellow')
                button.classList.add('btn-danger')
                setTimeout(() => {
                    button.innerText = 'agregar al carrito' 
                    button.classList.remove('btn-danger')
                    button.classList.add('bg-yellow')
                }, 2000);
            })
    })
