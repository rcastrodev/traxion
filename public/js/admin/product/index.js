let table = $('#page_table_slider').DataTable({
    serverSide: true,
    ajax: `${root}/get-list`,
    bSort: true,
    order: [],
    destroy: true,
    columns: [
        { data: "name" },
        { data: "description" },
        { data: "category" },
        { data: "order" },
        { data: 'actions', name: 'actions', orderable: false, searchable: false }
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
    }, 
});

function modalProductDestroy(id)
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
            elementProductDestroy(id)
        }
    })
}


function elementProductDestroy(id)
{
    axios.delete(`${root}/${id}`).then(r => {
        Swal.fire(
            'Eliminado!',
            '',
            'success'
        )
       table.ajax.reload()
    }).catch(error => console.error(error))

}


