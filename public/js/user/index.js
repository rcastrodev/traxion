let rootUser = document.querySelector('meta[name="url-user"]').getAttribute('content')
let csrf = document.querySelector('meta[name="_token"]').getAttribute('content')


let table = $('#table_users').DataTable({
    serverSide: true,
    ajax: `${rootUser}/get-list`,
    bSort: true,
    order: [],
    destroy: true,
    columns: [
        { data: "name" },
        { data: 'actions', name: 'actions', orderable: false, searchable: false }
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
    }, 
});

function destroyUser(id)
{
    fetch(`${rootUser}/${id}`, {
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

function modalDestroyUser(id)
{
    Swal.fire({
        title: 'Deseas eliminar el usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Si!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            destroyUser(id)
        }
      })
}

