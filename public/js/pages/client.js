$('#zona-cliente').click(function(e){
    $('.formularios').toggle()
})

$('#zona-cliente2').click(function(e){
    $('.formularios2').toggle()
})

$('#form-login2').submit(function(e){
    e.preventDefault()
    let form = e.currentTarget
    let formData = new FormData(form)
    axios.post(form.getAttribute('action'), formData).then(r => {
        if(parseInt(r.data.status) === 1){
            window.location.replace(`${document.getElementById('root').content}/lista-de-precios`)
        }else{
            let message = '<ul class="message">';
            message += `<li>${r.data.message}</li>`
            message += '</ul>'
            $('#login-message2').html(message)
    
            setTimeout(() => {
                setTimeout(() => {
                    $('#login-message2').html('')
                }, 5000);
            }, 2000);
        }
    }).catch(error => {
        let message = '<ul class="message">';

        for (const property in error.response.data.errors) 
            message += `<li>${error.response.data.errors[property]}</li>`
        
        message += '</ul>'

        $('#login-message2').html(message)

        setTimeout(() => {
            $('#login-message2').html('')
        }, 5000);
    })
})

$('#form-register2').submit(function(e){
    e.preventDefault()
    let form = e.currentTarget
    let formData = new FormData(form)
    axios.post(form.getAttribute('action'), formData)
        .then(r => {
            $('#register-message2').html('<p>Cliente creado, esperar la validación del administrador</p>')
            setTimeout(() => {
                $('#register-message2').html('')
                location.reload()
            }, 5000);
        })
        .catch(error => {
            let message = '<ul class="message">';

            for (const property in error.response.data.errors) 
                message += `<li>${error.response.data.errors[property]}</li>`
            
            message += '</ul>'

            $('#register-message2').html(message)

            setTimeout(() => {
                $('#register-message2').html('')
            }, 5000);
        })
})

$('#form-login').submit(function(e){
    e.preventDefault()
    let form = e.currentTarget
    let formData = new FormData(form)
    axios.post(form.getAttribute('action'), formData).then(r => {
        if(parseInt(r.data.status) === 1){
            window.location.replace(`${document.getElementById('root').content}/lista-de-precios`)
        }else{
            let message = '<ul class="message">';
            message += `<li>${r.data.message}</li>`
            message += '</ul>'
            $('#login-message').html(message)
    
            setTimeout(() => {
                setTimeout(() => {
                    $('#login-message').html('')
                }, 5000);
            }, 2000);
        }
    }).catch(error => {
        let message = '<ul class="message">';

        for (const property in error.response.data.errors) 
            message += `<li>${error.response.data.errors[property]}</li>`
        
        message += '</ul>'

        $('#login-message').html(message)

        setTimeout(() => {
            $('#login-message').html('')
        }, 5000);
    })
})

$('#form-register').submit(function(e){
    e.preventDefault()
    let form = e.currentTarget
    let formData = new FormData(form)
    axios.post(form.getAttribute('action'), formData)
        .then(r => {
            $('#register-message').html('<p>Cliente creado, esperar la validación del administrador</p>')
            setTimeout(() => {
                $('#register-message').html('')
                location.reload()
            }, 5000);
        })
        .catch(error => {
            let message = '<ul class="message">';

            for (const property in error.response.data.errors) 
                message += `<li>${error.response.data.errors[property]}</li>`
            
            message += '</ul>'

            $('#register-message').html(message)

            setTimeout(() => {
                $('#register-message').html('')
            }, 5000);
        })
})

$('.crear-cuenta').click(function(e){
    e.preventDefault()
    $('#form-login').hide()
    $('#form-register').show()
})

$('.ingresar').click(function(e){
    e.preventDefault()
    $('#form-login').show()
    $('#form-register').hide()
})

$('.crear-cuenta2').click(function(e){
    e.preventDefault()
    $('#form-login2').hide()
    $('#form-register2').show()
})

$('.ingresar2').click(function(e){
    e.preventDefault()
    $('#form-login2').show()
    $('#form-register2').hide()
})





