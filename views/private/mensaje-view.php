<div class="container-fluid p-3 p-md-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Gestión de Mensajes</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMensaje">
                    <ion-icon name="add-circle-outline" class="me-2"></ion-icon>
                    Nuevo Mensaje
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive table-responsive-custom">
                        <table class="table table-hover mb-0 table-custom table-mensajes">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="col-numero">#</th>
                                    <th scope="col" class="col-nombre">Nombre</th>
                                    <th scope="col" class="col-correo">Correo</th>
                                    <th scope="col" class="col-telefono">Teléfono</th>
                                    <th scope="col" class="col-asunto">Asunto</th>
                                    <th scope="col" class="col-fecha">Fecha</th>
                                    <th scope="col" class="col-acciones">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Juan Pérez</td>
                                    <td>juan.perez@example.com</td>
                                    <td>+591 77778888</td>
                                    <td>Consulta sobre productos</td>
                                    <td>2025-10-15 10:30</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-info" title="Ver Mensaje" data-bs-toggle="modal" data-bs-target="#modalVerMensaje1">
                                                <ion-icon name="mail-open-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-success" title="Responder">
                                                <ion-icon name="send-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>María González</td>
                                    <td>maria.gonzalez@example.com</td>
                                    <td>+591 77779999</td>
                                    <td>Solicitud de presupuesto</td>
                                    <td>2025-10-14 16:45</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-info" title="Ver Mensaje" data-bs-toggle="modal" data-bs-target="#modalVerMensaje2">
                                                <ion-icon name="mail-open-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-success" title="Responder">
                                                <ion-icon name="send-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Carlos Rodríguez</td>
                                    <td>carlos.rodriguez@example.com</td>
                                    <td>+591 77776666</td>
                                    <td>Problema técnico</td>
                                    <td>2025-10-14 09:20</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-info" title="Ver Mensaje" data-bs-toggle="modal" data-bs-target="#modalVerMensaje3">
                                                <ion-icon name="mail-open-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-success" title="Responder">
                                                <ion-icon name="send-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Ana Martínez</td>
                                    <td>ana.martinez@example.com</td>
                                    <td>+591 77775555</td>
                                    <td>Consulta general</td>
                                    <td>2025-10-13 14:15</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-info" title="Ver Mensaje" data-bs-toggle="modal" data-bs-target="#modalVerMensaje4">
                                                <ion-icon name="mail-open-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-success" title="Responder">
                                                <ion-icon name="send-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Luis Fernández</td>
                                    <td>luis.fernandez@example.com</td>
                                    <td>+591 77774444</td>
                                    <td>Reclamo de servicio</td>
                                    <td>2025-10-12 11:30</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-info" title="Ver Mensaje" data-bs-toggle="modal" data-bs-target="#modalVerMensaje5">
                                                <ion-icon name="mail-open-outline"></ion-icon>
                                            </button>
                                            <button class="btn btn-sm btn-outline-success" title="Responder">
                                                <ion-icon name="send-outline"></ion-icon>
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

<!-- Modal de Registro de Mensaje -->
<div class="modal fade" id="modalMensaje" tabindex="-1" aria-labelledby="modalMensajeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMensajeLabel">
                    <ion-icon name="mail-outline" class="me-2"></ion-icon>
                    Nuevo Mensaje
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="mes_nombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="mes_nombres" placeholder="Ingrese los nombres">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mes_apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="mes_apellidos" placeholder="Ingrese los apellidos">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="mes_correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="mes_correo" placeholder="Ingrese el correo">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mes_telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="mes_telefono" placeholder="Ingrese el teléfono">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="mes_asunto" class="form-label">Asunto</label>
                        <input type="text" class="form-control" id="mes_asunto" placeholder="Ingrese el asunto">
                    </div>
                    <div class="mb-3">
                        <label for="mes_mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="mes_mensaje" rows="4" placeholder="Ingrese el mensaje"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">
                    <ion-icon name="send-outline" class="me-2"></ion-icon>
                    Enviar Mensaje
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modales para ver mensajes completos -->
<div class="modal fade" id="modalVerMensaje1" tabindex="-1" aria-labelledby="modalVerMensaje1Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerMensaje1Label">Mensaje de Juan Pérez</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Correo:</strong> juan.perez@example.com</p>
                <p><strong>Teléfono:</strong> +591 77778888</p>
                <p><strong>Asunto:</strong> Consulta sobre productos</p>
                <hr>
                <p><strong>Mensaje:</strong></p>
                <p>Buenos días, quisiera saber más información sobre sus productos premium y los tiempos de entrega para pedidos al por mayor. Gracias.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalVerMensaje2" tabindex="-1" aria-labelledby="modalVerMensaje2Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerMensaje2Label">Mensaje de María González</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Correo:</strong> maria.gonzalez@example.com</p>
                <p><strong>Teléfono:</strong> +591 77779999</p>
                <p><strong>Asunto:</strong> Solicitud de presupuesto</p>
                <hr>
                <p><strong>Mensaje:</strong></p>
                <p>Hola, necesito un presupuesto para el servicio de consultoría financiera para mi empresa. Podrían enviarme información detallada por favor.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalVerMensaje3" tabindex="-1" aria-labelledby="modalVerMensaje3Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerMensaje3Label">Mensaje de Carlos Rodríguez</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Correo:</strong> carlos.rodriguez@example.com</p>
                <p><strong>Teléfono:</strong> +591 77776666</p>
                <p><strong>Asunto:</strong> Problema técnico</p>
                <hr>
                <p><strong>Mensaje:</strong></p>
                <p>Buenas tardes, estoy teniendo problemas con el acceso a su plataforma. El sistema no me permite iniciar sesión y me muestra un error de conexión. Necesito ayuda urgente.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalVerMensaje4" tabindex="-1" aria-labelledby="modalVerMensaje4Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerMensaje4Label">Mensaje de Ana Martínez</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Correo:</strong> ana.martinez@example.com</p>
                <p><strong>Teléfono:</strong> +591 77775555</p>
                <p><strong>Asunto:</strong> Consulta general</p>
                <hr>
                <p><strong>Mensaje:</strong></p>
                <p>Hola, quisiera saber cuáles son sus horarios de atención al cliente y si tienen soporte técnico los fines de semana. Gracias.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalVerMensaje5" tabindex="-1" aria-labelledby="modalVerMensaje5Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerMensaje5Label">Mensaje de Luis Fernández</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Correo:</strong> luis.fernandez@example.com</p>
                <p><strong>Teléfono:</strong> +591 77774444</p>
                <p><strong>Asunto:</strong> Reclamo de servicio</p>
                <hr>
                <p><strong>Mensaje:</strong></p>
                <p>Muy buenas, quiero presentar un reclamo formal por el servicio de mantenimiento técnico que contrató mi empresa. El técnico no llegó a la hora acordada y no se comunicó para avisar. Esto nos causó pérdidas significativas.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>