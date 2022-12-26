let root = document.querySelector('meta[name="url"]').getAttribute('content')
let csrf = document.querySelector('meta[name="_token"]').getAttribute('content')


let table = $('#home_table_slider').DataTable({
    serverSide: true,
    ajax: `${root}/get-list`,
    bSort: true,
    order: [],
    destroy: true,
    columns: [
        { data: "image" },
        { data: "content_1" },
        { data: "content_2"},
        { data: 'actions', name: 'actions', orderable: false, searchable: false }
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
    }, 
});

function destroy(id)
{
    fetch(`${root}/${id}`, {
        method: 'Delete',
        headers: {
         'Content-type': 'application/json',
         'X-CSRF-TOKEN': csrf
        }
    })
    .then(resp => resp.json())
    .then(resp => {
        Swal.fire(
            'Eliminado!',
            '',
            'success'
        )

        table.ajax.reload()
    })
    .catch(error => console.error(error))
}

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
            destroy(id)
        }
      })
}

