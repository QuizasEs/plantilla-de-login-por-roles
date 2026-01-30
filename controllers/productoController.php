<?php
require_once "../models/productoModel.php";

class productoController extends productoModel
{
    /*----------  Controlador agregar producto  ----------*/
    public function agregar_producto_controlador()
    {
        $titulo = $this->limpiar_cadena($_POST['producto_titulo']);
        $descripcion = $this->limpiar_cadena($_POST['producto_descripcion']);
        $puntaje = $this->limpiar_cadena($_POST['producto_puntaje']);
        $precio = $this->limpiar_cadena($_POST['producto_precio']);
        $link_video = $this->limpiar_cadena($_POST['producto_link_video']);

        /*== Verificando campos obligatorios ==*/
        if ($titulo == "" || $descripcion == "" || $precio == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*== Verificando integridad de los campos ==*/
        if ($this->verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,255}", $titulo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "El TITULO no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($this->verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,500}", $descripcion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "La DESCRIPCIÓN no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($puntaje != "" && !is_numeric($puntaje)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "El PUNTAJE no es un valor numérico válido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (!is_numeric($precio)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "El PRECIO no es un valor numérico válido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*== Verificando titulo ==*/
        if ($this->contar_registros("productos", "pro_titulo", $titulo) > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "El TITULO ingresado ya se encuentra registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*== Directorios de imagenes ==*/
        $img_dir = "../assets/productos/";

        /*== Subir imagen principal ==*/
        $resultado_imagen = mainModel::subir_imagen('producto_imagen_principal', $img_dir, 'producto_imagen_principal');
        if (!$resultado_imagen['exito']) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => $resultado_imagen['mensaje'],
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $foto = $resultado_imagen['nombre_archivo'];

        /*== Directorios de imagenes secundarias ==*/
        $img_dir_sec = "../assets/productos/secundarias/";

        /*== Subir imagenes secundarias ==*/
        $imagenes_secundarias = [];
        for ($i = 1; $i <= 3; $i++) {
            $campo_imagen = "producto_imagen_secundaria" . $i;
            $resultado_imagen = mainModel::subir_imagen($campo_imagen, $img_dir_sec, $campo_imagen);
            if ($resultado_imagen['exito']) {
                $imagenes_secundarias[$i] = $resultado_imagen['nombre_archivo'];
            } else {
                $imagenes_secundarias[$i] = "";
            }
        }

        $datos = [
            "titulo" => $titulo,
            "imagen_principal" => $foto,
            "imagen_secundaria1" => $imagenes_secundarias[1],
            "imagen_secundaria2" => $imagenes_secundarias[2],
            "imagen_secundaria3" => $imagenes_secundarias[3],
            "descripcion" => $descripcion,
            "puntaje" => $puntaje,
            "precio" => $precio,
            "link_video" => $link_video
        ];

        $guardar = $this->agregar_producto_modelo($datos);

        if ($guardar->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Producto registrado",
                "texto" => "El producto se registró con éxito",
                "Tipo" => "success"
            ];
        } else {
        /*== Eliminar imagenes si falló el registro ==*/
        if ($foto != "") {
            mainModel::eliminar_imagen($foto, $img_dir);
        }
        $imagenes_a_eliminar = array_filter($imagenes_secundarias);
        if (!empty($imagenes_a_eliminar)) {
            mainModel::eliminar_multiples_imagenes($imagenes_a_eliminar, $img_dir_sec);
        }

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "No se pudo registrar el producto",
                "Tipo" => "error"
            ];
        }

        echo json_encode($alerta);
    }

    /*----------  Controlador listar productos  ----------*/
    public function listar_productos_controlador($pagina, $registros, $busqueda)
    {
        $pagina = $this->limpiar_cadena($pagina);
        $registros = $this->limpiar_cadena($registros);
        $busqueda = $this->limpiar_cadena($busqueda);
        $url = "producto";
        $pagina = ($pagina >= 1) ? (int)$pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        $datos = $this->listar_productos_modelo($inicio, $registros, $busqueda);
        $total = $this->contar_productos_modelo($busqueda);

        $tabla = '';
        $pagina_actual = mainModel::paginador_tablas($pagina, $total[0]['COUNT(pro_id)'], $url, 7);

        if ($total[0]['COUNT(pro_id)'] >= 1 && $datos->rowCount() >= 1) {
            $contador = $inicio + 1;
            $datos = $datos->fetchAll();

            foreach ($datos as $rows) {
                $tabla .= '
                <tr>
                    <th scope="row">' . $contador . '</th>
                    <td>' . $rows['pro_titulo'] . '</td>
                    <td>' . $rows['pro_descripcion'] . '</td>
                    <td>' . $rows['pro_precio'] . '</td>
                    <td>' . $rows['pro_puntaje'] . '</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-outline-primary btn-editar-producto" onclick="obtener_producto_js(' . $rows['pro_id'] . ')" title="Editar">
                                <ion-icon name="create-outline"></ion-icon>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-eliminar-producto" onclick="eliminar_producto_js(' . $rows['pro_id'] . ')" title="Eliminar">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </div>
                    </td>
                </tr>';
                $contador++;
            }
        } else {
            if ($total[0]['COUNT(pro_id)'] >= 1) {
                $tabla = '
                <tr>
                    <td colspan="6" class="text-center">
                        <p>No hay coincidencias con la búsqueda.</p>
                    </td>
                </tr>';
            } else {
                $tabla = '
                <tr>
                    <td colspan="6">
                        <p class="text-center">No hay registros en el sistema</p>
                    </td>
                </tr>';
            }
        }

        return '
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
                    ' . $tabla . '
                </tbody>
            </table>
        </div>
        ' . $pagina_actual;
    }

    /*----------  Controlador actualizar producto  ----------*/
    public function actualizar_producto_controlador()
    {
        $id = $this->limpiar_cadena($_POST['producto_id']);
        $titulo = $this->limpiar_cadena($_POST['producto_titulo']);
        $descripcion = $this->limpiar_cadena($_POST['producto_descripcion']);
        $puntaje = $this->limpiar_cadena($_POST['producto_puntaje']);
        $precio = $this->limpiar_cadena($_POST['producto_precio']);
        $link_video = $this->limpiar_cadena($_POST['producto_link_video']);

        /*== Verificando producto ==*/
        $datos = $this->obtener_producto_modelo($id);
        if ($datos->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "No se encontró el producto en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $datos = $datos->fetch();
        }

        /*== Verificando campos obligatorios ==*/
        if ($titulo == "" || $descripcion == "" || $precio == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*== Verificando integridad de los campos ==*/
        if ($this->verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,255}", $titulo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "El TITULO no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($this->verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,500}", $descripcion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "La DESCRIPCIÓN no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($puntaje != "" && !is_numeric($puntaje)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "El PUNTAJE no es un valor numérico válido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (!is_numeric($precio)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "El PRECIO no es un valor numérico válido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*== Verificando titulo ==*/
        if ($datos['pro_titulo'] != $titulo) {
            if ($this->contar_registros("productos", "pro_titulo", $titulo) > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "texto" => "El TITULO ingresado ya se encuentra registrado en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        /*== Directorios de imagenes ==*/
        $img_dir = "../assets/productos/";

        /*== Subir imagen principal ==*/
        $foto = $datos['pro_imagen_principal']; // Valor por defecto (imagen existente)
        if (isset($_FILES['producto_imagen_principal']) && ($_FILES['producto_imagen_principal']['name'] != "" || $_FILES['producto_imagen_principal']['size'] > 0)) {
            // Eliminar imagen antigua si existe
            if (!empty($datos['pro_imagen_principal'])) {
                mainModel::eliminar_imagen($datos['pro_imagen_principal'], $img_dir);
            }
            
            $resultado_imagen = mainModel::subir_imagen('producto_imagen_principal', $img_dir, 'producto_imagen_principal');
            if (!$resultado_imagen['exito']) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "texto" => $resultado_imagen['mensaje'],
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $foto = $resultado_imagen['nombre_archivo'];
        }

        /*== Directorios de imagenes secundarias ==*/
        $img_dir_sec = "../assets/productos/secundarias/";

        /*== Subir imagenes secundarias ==*/
        $imagenes_secundarias = [];
        for ($i = 1; $i <= 3; $i++) {
            $campo_imagen = "producto_imagen_secundaria" . $i;
            $campo_bd = "pro_imagen_secundaria$i";
            
            // Valor por defecto (imagen existente)
            $imagenes_secundarias[$i] = $datos[$campo_bd];
            
            if (isset($_FILES[$campo_imagen]) && ($_FILES[$campo_imagen]['name'] != "" || $_FILES[$campo_imagen]['size'] > 0)) {
                // Eliminar imagen antigua si existe
                if (!empty($datos[$campo_bd])) {
                    mainModel::eliminar_imagen($datos[$campo_bd], $img_dir_sec);
                }
                
                $resultado_imagen = mainModel::subir_imagen($campo_imagen, $img_dir_sec, $campo_imagen);
                if ($resultado_imagen['exito']) {
                    $imagenes_secundarias[$i] = $resultado_imagen['nombre_archivo'];
                }
            }
        }

        $datos = [
            "titulo" => $titulo,
            "imagen_principal" => $foto,
            "imagen_secundaria1" => $imagenes_secundarias[1],
            "imagen_secundaria2" => $imagenes_secundarias[2],
            "imagen_secundaria3" => $imagenes_secundarias[3],
            "descripcion" => $descripcion,
            "puntaje" => $puntaje,
            "precio" => $precio,
            "link_video" => $link_video,
            "id" => $id
        ];

        $actualizar = $this->actualizar_producto_modelo($datos);

        if ($actualizar->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Producto actualizado",
                "texto" => "Los datos del producto se actualizaron con éxito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "No se pudo actualizar los datos del producto",
                "Tipo" => "error"
            ];
        }

        echo json_encode($alerta);
    }

    /*----------  Controlador eliminar producto  ----------*/
    public function eliminar_producto_controlador()
    {
        $id = $this->limpiar_cadena($_POST['producto_id']);

        /*== Verificando producto ==*/
        $datos = $this->obtener_producto_modelo($id);
        if ($datos->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "No se encontró el producto en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $datos = $datos->fetch();
        }

        /*== Directorios de imagenes ==*/
        $img_dir = "../assets/productos/";
        $img_dir_sec = "../assets/productos/secundarias/";

        /*== Eliminando imagenes ==*/
        mainModel::eliminar_imagen($datos['pro_imagen_principal'], $img_dir);
        
        $imagenes_a_eliminar = [];
        for ($i = 1; $i <= 3; $i++) {
            $campo_imagen = "pro_imagen_secundaria$i";
            if (!empty($datos[$campo_imagen])) {
                $imagenes_a_eliminar[] = $datos[$campo_imagen];
            }
        }
        if (!empty($imagenes_a_eliminar)) {
            mainModel::eliminar_multiples_imagenes($imagenes_a_eliminar, $img_dir_sec);
        }

        $eliminar = $this->eliminar_producto_modelo($id);

        if ($eliminar->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Producto eliminado",
                "texto" => "El producto se eliminó del sistema exitosamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "texto" => "No se pudo eliminar el producto del sistema",
                "Tipo" => "error"
            ];
        }

        echo json_encode($alerta);
    }

    /*----------  Controlador obtener producto  ----------*/
    public function obtener_producto_controlador()
    {
        $id = $this->limpiar_cadena($_POST['producto_id']);

        $datos = $this->obtener_producto_modelo($id);

        if ($datos->rowCount() > 0) {
            $producto = $datos->fetch(PDO::FETCH_ASSOC);
            echo json_encode($producto);
        } else {
            echo json_encode(['error' => 'Producto no encontrado']);
        }
    }
}