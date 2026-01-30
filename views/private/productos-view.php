<div class="container-fluid p-md-4 productos-view-identifier">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Gestión de Productos</h2>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control" id="input_buscador" placeholder="Buscar producto..." onkeyup="listar_productos_js(1)">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
                    <ion-icon name="add-circle-outline" class="me-2"></ion-icon>
                    Registrar Producto
                </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0" id="tabla_productos">
                    <!-- La tabla se cargará aquí mediante AJAX -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Registro de Producto -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="modalProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProductoLabel">
                    <ion-icon name="cube-outline" class="me-2"></ion-icon>
                    Registrar Nuevo Producto
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="FormularioAjax" id="form_agregar_producto" action="<?php echo SERVER_URL; ?>ajax/productoAjax.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="producto_titulo_reg" value="1">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="pro_titulo" class="form-label">Título del Producto</label>
                            <input type="text" class="form-control" name="producto_titulo" id="pro_titulo" placeholder="Ingrese el título" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pro_precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="producto_precio" id="pro_precio" step="0.01" placeholder="Ingrese el precio" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="pro_puntaje" class="form-label">Puntaje</label>
                            <input type="number" class="form-control" name="producto_puntaje" id="pro_puntaje" step="0.1" max="5" placeholder="0.0 - 5.0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pro_link_video" class="form-label">Enlace de Video</label>
                            <input type="url" class="form-control" name="producto_link_video" id="pro_link_video" placeholder="https://...">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pro_descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" name="producto_descripcion" id="pro_descripcion" rows="3" placeholder="Descripción del producto" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="pro_imagen_principal" class="form-label">Imagen Principal</label>
                            <input type="file" class="form-control mb-2" name="producto_imagen_principal" id="pro_imagen_principal" accept="image/*" onchange="previewImage(this, 'preview_principal')">
                            <img id="preview_principal" src="<?php echo SERVER_URL; ?>views/assets/img/default.png" class="img-fluid rounded border" style="height: 100px; width: 100%; object-fit: cover;" alt="Preview">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pro_imagen_secundaria1" class="form-label">Imagen 1</label>
                            <input type="file" class="form-control mb-2" name="producto_imagen_secundaria1" id="pro_imagen_secundaria1" accept="image/*" onchange="previewImage(this, 'preview_sec1')">
                            <img id="preview_sec1" src="<?php echo SERVER_URL; ?>views/assets/img/default.png" class="img-fluid rounded border" style="height: 100px; width: 100%; object-fit: cover;" alt="Preview">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pro_imagen_secundaria2" class="form-label">Imagen 2</label>
                            <input type="file" class="form-control mb-2" name="producto_imagen_secundaria2" id="pro_imagen_secundaria2" accept="image/*" onchange="previewImage(this, 'preview_sec2')">
                            <img id="preview_sec2" src="<?php echo SERVER_URL; ?>views/assets/img/default.png" class="img-fluid rounded border" style="height: 100px; width: 100%; object-fit: cover;" alt="Preview">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pro_imagen_secundaria3" class="form-label">Imagen 3</label>
                            <input type="file" class="form-control mb-2" name="producto_imagen_secundaria3" id="pro_imagen_secundaria3" accept="image/*" onchange="previewImage(this, 'preview_sec3')">
                            <img id="preview_sec3" src="<?php echo SERVER_URL; ?>views/assets/img/default.png" class="img-fluid rounded border" style="height: 100px; width: 100%; object-fit: cover;" alt="Preview">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <ion-icon name="save-outline" class="me-2"></ion-icon>
                            Guardar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Actualización de Producto -->
<div class="modal fade" id="modalProductoUpdate" tabindex="-1" aria-labelledby="modalProductoUpdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProductoUpdateLabel">
                    <ion-icon name="sync-outline" class="me-2"></ion-icon>
                    Actualizar Producto
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="FormularioAjax" id="form_actualizar_producto" action="<?php echo SERVER_URL; ?>ajax/productoAjax.php" method="POST" data-form="update" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="producto_id_up" id="up_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="up_titulo" class="form-label">Título del Producto</label>
                            <input type="text" class="form-control" name="producto_titulo" id="up_titulo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="up_precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="producto_precio" id="up_precio" step="0.01" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="up_puntaje" class="form-label">Puntaje</label>
                            <input type="number" class="form-control" name="producto_puntaje" id="up_puntaje" step="0.1" max="5">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="up_link_video" class="form-label">Enlace de Video</label>
                            <input type="url" class="form-control" name="producto_link_video" id="up_link_video">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="up_descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" name="producto_descripcion" id="up_descripcion" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Imagen Principal</label>
                            <input type="file" class="form-control mb-2" name="producto_imagen_principal" accept="image/*" onchange="previewImage(this, 'up_preview_principal')">
                            <img id="up_preview_principal" src="" class="img-fluid rounded border" style="height: 100px; width: 100%; object-fit: cover;" alt="Preview">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Imagen 1</label>
                            <input type="file" class="form-control mb-2" name="producto_imagen_secundaria1" accept="image/*" onchange="previewImage(this, 'up_preview_sec1')">
                            <img id="up_preview_sec1" src="" class="img-fluid rounded border" style="height: 100px; width: 100%; object-fit: cover;" alt="Preview">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Imagen 2</label>
                            <input type="file" class="form-control mb-2" name="producto_imagen_secundaria2" accept="image/*" onchange="previewImage(this, 'up_preview_sec2')">
                            <img id="up_preview_sec2" src="" class="img-fluid rounded border" style="height: 100px; width: 100%; object-fit: cover;" alt="Preview">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Imagen 3</label>
                            <input type="file" class="form-control mb-2" name="producto_imagen_secundaria3" accept="image/*" onchange="previewImage(this, 'up_preview_sec3')">
                            <img id="up_preview_sec3" src="" class="img-fluid rounded border" style="height: 100px; width: 100%; object-fit: cover;" alt="Preview">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <ion-icon name="sync-outline" class="me-2"></ion-icon>
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo SERVER_URL; ?>views/script/producto.js"></script>