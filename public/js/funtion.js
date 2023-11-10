function ftnDelPersona(id) {
    swal({
        title: "Realmente quieres eliminar el registro",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            swal("Eliminando registro", {
                icon: "success",
            });

            // Espera 2 segundos (2000 milisegundos) antes de enviar el formulario
            setTimeout(function() {
                document.getElementById("deleteForm").submit();
            }, 2000);
        } else {
            swal("Se ha cancelado la acción");
        }
    });
}
