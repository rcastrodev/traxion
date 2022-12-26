let table = $('#page_table_slider').DataTable({
    serverSide: true,
    ajax: `${root}/get-list`,
    bSort: true,
    order: [],
    destroy: true,
    columns: [
        { data: "name" },
        { data: "category", name: 'category.name' },
        { data: "type" },
        { data: 'actions', name: 'actions', orderable: false, searchable: false }
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
    }, 
});

function dataSliderContent(content)
{
    let form = document.getElementById('form-update-slider')
    form.reset()
    form.querySelectorAll('option').forEach(e => {
        if (e.getAttribute('value') == content.category_id) 
            e.setAttribute('selected', true)
        else
            e.removeAttribute('selected')
    })
    
    form.querySelector('input[name="id"]').setAttribute('value', content.id)
    form.querySelector('input[name="name"]').setAttribute('value', content.name)
    form.querySelector('input[name="type"]').setAttribute('value', content.type)
    
}

