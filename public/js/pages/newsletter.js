let forNewsLetter = document.getElementById('formNewsletter')
async function storeNewsLetter(e){
    e.preventDefault()
    let form = e.currentTarget
    let formData = new FormData(form)
    let btn = form.querySelector('button')

    try {
        let result = await axios.post(form.getAttribute('action'), formData)
        $('#text-newsletter').text('Creado')
    
    } catch (error) {
        $('#text-newsletter').text('Error al crear')
    }
    
}
forNewsLetter.addEventListener('submit', storeNewsLetter)