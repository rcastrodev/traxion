let section1 = document.querySelector('#section1')
let section2 = document.querySelector('#section2')
let buttonS1 = section1.querySelector('#btnS1')
let buttonS2 = document.querySelector('#btnS2')

if (buttonS1) {
    buttonS1.addEventListener('click', function(e){
    
        e.preventDefault()
    
        let inputs = section1.querySelectorAll('.valid')
        inputs = Object.values(inputs).filter( element => {
            if(element.value.length) { return element }
        })
        
        if(inputs.length < 3)
        {
            buttonS1.textContent = 'Algunos datos son obligatorios'
            setTimeout(() => {
                buttonS1.textContent = 'Siguiente'
            }, 1000);
        }else{
            section1.classList.remove('d-block')
            section1.classList.add('d-none')
            section2.classList.remove('d-none')
            section2.classList.add('d-block')
        }
    })   
}

if (buttonS2) {
    buttonS2.addEventListener('click', function(e){
        e.preventDefault()
        section2.classList.remove('d-block')
        section2.classList.add('d-none')
        section1.classList.remove('d-none')
        section1.classList.add('d-block')
    })  
}

let tableCotizacion = document.getElementById('table')

function removeItem(e)
{
    e.preventDefault()
    let btn = e.target
    if(! btn.classList.contains('removeItem')) 
        return undefined

    axios.delete(`${btn.dataset.url}`)
        .then(response => btn.closest('tr').remove())
        .catch(error => console.error(error))

 
}
tableCotizacion.addEventListener('click', removeItem)


