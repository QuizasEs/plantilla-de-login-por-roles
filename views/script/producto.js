document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.productos-view-identifier')) {
        listar_productos_js(1);
    }

});

function listar_productos_js(pagina) {
    const busqueda = document.querySelector('#input_buscador')?.value || "";
    const container = document.querySelector('#tabla_productos');
    
    if (!container) return;

    const formData = new FormData();
    formData.append('pagina', pagina);
    formData.append('busqueda', busqueda);

    fetch('ajax/productoAjax.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(res => {
        container.innerHTML = res;
        
        // Manejar clics en la paginación para que no recargue la página
        const paginationLinks = container.querySelectorAll('.pagination-link');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const page = this.getAttribute('data-page');
                if (page) {
                    listar_productos_js(page);
                }
            });
        });
    });
}

function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = "assets/img/default.png";
    }
}

function obtener_producto_js(id) {
    const formData = new FormData();
    formData.append('producto_id_get', id);

    fetch('ajax/productoAjax.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if (!res.error) {
            document.querySelector('#up_id').value = res.pro_id;
            document.querySelector('#up_titulo').value = res.pro_titulo;
            document.querySelector('#up_precio').value = res.pro_precio;
            document.querySelector('#up_puntaje').value = res.pro_puntaje;
            document.querySelector('#up_link_video').value = res.pro_link_video;
            document.querySelector('#up_descripcion').value = res.pro_descripcion;
            
            // Preview images
            document.querySelector('#up_preview_principal').src = res.pro_imagen_principal ? 'assets/productos/' + res.pro_imagen_principal : 'assets/img/default.png';
            document.querySelector('#up_preview_sec1').src = res.pro_imagen_secundaria1 ? 'assets/productos/secundarias/' + res.pro_imagen_secundaria1 : 'assets/img/default.png';
            document.querySelector('#up_preview_sec2').src = res.pro_imagen_secundaria2 ? 'assets/productos/secundarias/' + res.pro_imagen_secundaria2 : 'assets/img/default.png';
            document.querySelector('#up_preview_sec3').src = res.pro_imagen_secundaria3 ? 'assets/productos/secundarias/' + res.pro_imagen_secundaria3 : 'assets/img/default.png';

            const modal = new bootstrap.Modal(document.getElementById('modalProductoUpdate'));
            modal.show();
        } else {
            Swal.fire({
                title: 'Error',
                text: res.error,
                icon: 'error'
            });
        }
    });
}

function eliminar_producto_js(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Deseas eliminar este producto permanentemente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('producto_id_del', id);

            fetch('ajax/productoAjax.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if (res.Alerta === "recargar") {
                    Swal.fire({
                        title: res.Titulo,
                        text: res.texto,
                        icon: res.Tipo,
                        confirmButtonText: "Aceptar"
                    }).then(() => {
                        listar_productos_js(1);
                    });
                } else {
                    alertas_ajax(res);
                }
            });
        }
    });
}
