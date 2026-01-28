<div class="container-fluid p-3 p-md-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Gestión de Servicios</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalServicio">
                    <ion-icon name="add-circle-outline" class="me-2"></ion-icon>
                    Registrar Servicio
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive table-responsive-custom">
                        <table class="table table-hover mb-0 table-custom table-servicios">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="col-numero">#</th>
                                    <th scope="col" class="col-titulo">Título</th>
                                    <th scope="col" class="col-descripcion">Descripción</th>
                                    <th scope="col" class="col-precio">Precio</th>
                                    <th scope="col" class="col-acciones">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Consultoría Premium</td>
                                    <td>Servicio de consultoría empresarial con asesoramiento estratégico</td>
                                    <td>$500.00</td>
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
                                    <td>Mantenimiento Técnico</td>
                                    <td>Servicio de mantenimiento preventivo y correctivo</td>
                                    <td>$150.00</td>
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
                                    <td>Diseño Web</td>
                                    <td>Diseño y desarrollo de páginas web profesionales</td>
                                    <td>$800.00</td>
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
                                    <td>Capacitación Corporativa</td>
                                    <td>Servicio de capacitación y entrenamiento para equipos</td>
                                    <td>$300.00</td>
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
                                    <td>Soporte Técnico 24/7</td>
                                    <td>Soporte técnico continuo y resolución de incidencias</td>
                                    <td>$200.00</td>
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
                                    <th scope="row">6</th>
                                    <td>Consultoría Financiera</td>
                                    <td>Asesoramiento financiero y planificación estratégica</td>
                                    <td>$600.00</td>
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
</div>

<!-- Modal de Registro de Servicio -->
<div class="modal fade" id="modalServicio" tabindex="-1" aria-labelledby="modalServicioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalServicioLabel">
                    <ion-icon name="construct-outline" class="me-2"></ion-icon>
                    Registrar Nuevo Servicio
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ser_titulo" class="form-label">Título del Servicio</label>
                            <input type="text" class="form-control" id="ser_titulo" placeholder="Ingrese el título">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ser_precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="ser_precio" step="0.01" placeholder="Ingrese el precio">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="ser_descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="ser_descripcion" rows="3" placeholder="Descripción del servicio"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="ser_imagen_principal" class="form-label">Imagen Principal</label>
                            <input type="file" class="form-control" id="ser_imagen_principal">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="ser_imagen_secundaria1" class="form-label">Imagen 1</label>
                            <input type="file" class="form-control" id="ser_imagen_secundaria1">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="ser_imagen_secundaria2" class="form-label">Imagen 2</label>
                            <input type="file" class="form-control" id="ser_imagen_secundaria2">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="ser_imagen_secundaria3" class="form-label">Imagen 3</label>
                            <input type="file" class="form-control" id="ser_imagen_secundaria3">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">
                    <ion-icon name="save-outline" class="me-2"></ion-icon>
                    Guardar Servicio
                </button>
            </div>
        </div>
    </div>
</div>