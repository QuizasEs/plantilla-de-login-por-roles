<div class="container-fluid  p-md-4 table-container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Gestión de Productos</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
                    <ion-icon name="add-circle-outline" class="me-2"></ion-icon>
                    Registrar Producto
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive table-responsive-custom">
                        <table class="table table-hover mb-0 table-custom table-productos">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="col-numero">#</th>
                                    <th scope="col" class="col-titulo">Título</th>
                                    <th scope="col" class="col-descripcion">Descripción</th>
                                    <th scope="col" class="col-precio">Precio</th>
                                    <th scope="col" class="col-puntaje">Puntaje</th>
                                    <th scope="col" class="col-acciones">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Producto Premium</td>
                                    <td>Producto de alta calidad con garantía extendida</td>
                                    <td>$99.99</td>
                                    <td>4.8</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-primary" title="Editar">
                                                <ion-icon name="create-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Producto Estándar</td>
                                    <td>Producto básico para uso diario</td>
                                    <td>$49.99</td>
                                    <td>4.2</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-primary" title="Editar">
                                                <ion-icon name="create-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Producto Económico</td>
                                    <td>Producto con excelente relación calidad-precio</td>
                                    <td>$29.99</td>
                                    <td>3.9</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-primary" title="Editar">
                                                <ion-icon name="create-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Producto Profesional</td>
                                    <td>Producto diseñado para profesionales</td>
                                    <td>$199.99</td>
                                    <td>4.9</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-primary" title="Editar">
                                                <ion-icon name="create-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Producto Familiar</td>
                                    <td>Producto ideal para toda la familia</td>
                                    <td>$79.99</td>
                                    <td>4.5</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-primary" title="Editar">
                                                <ion-icon name="create-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Paginación mejorada -->
    <div class="pagination-container">
        <nav aria-label="Page navigation example" class="pagination-container">
            <ul class="pagination justify-content-center flex-wrap">
                <!-- Botón "Anterior" y "<<" -->
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" aria-hidden="true">
                        <ion-icon name="chevron-back-circle-outline"></ion-icon>
                    </span>
                </li>
                
                <!-- Números de página -->
                <li class="page-item active" aria-current="page">
                    <span class="page-link">
                        1
                        <span class="sr-only">(current)</span>
                    </span>
                </li>
                <li class="page-item">
                    <a class="page-link pagination-link" href="#" data-page="2">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link pagination-link" href="#" data-page="3">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link pagination-link" href="#" data-page="4">4</a>
                </li>
                <li class="page-item">
                    <a class="page-link pagination-link" href="#" data-page="5">5</a>
                </li>
                
                <!-- Botón "Siguiente" y ">>" -->
                <li class="page-item">
                    <a class="page-link pagination-link" href="#" data-page="2" aria-label="Siguiente">
                        <ion-icon name="chevron-forward-circle-outline"></ion-icon>
                    </a>
                </li>
            </ul>
        </nav>
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
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="pro_titulo" class="form-label">Título del Producto</label>
                            <input type="text" class="form-control" id="pro_titulo" placeholder="Ingrese el título">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pro_precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="pro_precio" step="0.01" placeholder="Ingrese el precio">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="pro_puntaje" class="form-label">Puntaje</label>
                            <input type="number" class="form-control" id="pro_puntaje" step="0.1" max="5" placeholder="0.0 - 5.0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pro_link_video" class="form-label">Enlace de Video</label>
                            <input type="url" class="form-control" id="pro_link_video" placeholder="https://...">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pro_descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="pro_descripcion" rows="3" placeholder="Descripción del producto"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="pro_imagen_principal" class="form-label">Imagen Principal</label>
                            <input type="file" class="form-control" id="pro_imagen_principal">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pro_imagen_secundaria1" class="form-label">Imagen 1</label>
                            <input type="file" class="form-control" id="pro_imagen_secundaria1">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pro_imagen_secundaria2" class="form-label">Imagen 2</label>
                            <input type="file" class="form-control" id="pro_imagen_secundaria2">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pro_imagen_secundaria3" class="form-label">Imagen 3</label>
                            <input type="file" class="form-control" id="pro_imagen_secundaria3">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">
                    <ion-icon name="save-outline" class="me-2"></ion-icon>
                    Guardar Producto
                </button>
            </div>
        </div>
    </div>
</div>