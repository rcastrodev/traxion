let table = $('#page_table_slider').DataTable({
    serverSide: true,
    ajax: `${root}/get-list`,
    bSort: true,
    order: [],
    destroy: true,
    columns: [
        { data: "name" },
        { data: "email" },
        { data: "status" },
        { data: 'actions', name: 'actions', orderable: false, searchable: false }
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
    }, 
});

const client =  async (id, form) => {
    const root = `${$('meta[name="url"]').attr('content')}/customer-list-prices/${id}`

    try {
        const c =  await axios.get(root)
        $("#priceLists").val(c.data.priceLists);
        $('#priceLists').trigger('change')

    } catch (error) {
        console.error(error)
    }   

}

function dataSliderContent(content)
{
    let form = document.getElementById('form-update-slider')
    form.reset()

    form.querySelector('input[name="id"]').setAttribute('value', content.id)
    form.querySelector('input[name="name"]').setAttribute('value', content.name)
    form.querySelector('input[name="email"]').setAttribute('value', content.email)
    
    if (content.status) 
        form.querySelector('input[name="status"]').setAttribute('checked', 'on')
    else 
        form.querySelector('input[name="status"]').removeAttribute('checked')

    client(content.id, form)
    
}



function modalDestroyClient(id)
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
            destroyClient(id)
        }
      })
}

function destroyClient(id)
{
    axios.post(`${root}/${id}`).then(r => {
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

