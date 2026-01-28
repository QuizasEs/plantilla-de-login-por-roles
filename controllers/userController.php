<?php
if ($peticionAjax) {
    require_once "../models/userModel.php";
} else {
    require_once "./models/userModel.php";
}

class userController extends userModel
{

    /* -----------------------------------controlador para agregar usuarios------------------------------------------ */
    public function get_user_controller()
    {
        /* datos personales */
        $nombres = mainModel::limpiar_cadena($_POST['Nombres_reg']);
        $apellidos = mainModel::limpiar_cadena($_POST['Apellidos_reg']);
        $correo = mainModel::limpiar_cadena($_POST['Correo_reg']);

        /* datos de usuario */
        $usuarioName = mainModel::limpiar_cadena($_POST['UsuarioName_reg']);
        $password = mainModel::limpiar_cadena($_POST['Password_reg']);
        $password_confirm = mainModel::limpiar_cadena($_POST['PasswordConfirm_reg']);
        $sucursal =  mainModel::limpiar_cadena($_POST['Sucursal_reg']);
        $rol = mainModel::limpiar_cadena($_POST['Rol_reg']);
        $sucursal = (int)$sucursal;
        $rol = (int)$rol;


        /* combertimos enteros los campos */


        /* comprobar que los campos obligatorios no esten vacios */
        if ($nombres == "" || $apellidos == "" || $usuarioName == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "No se han llenado todos los campos obligatorios!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* verificar la integridad de los datos (patern) */
        /* nombres */
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,120}", $nombres)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "Los NOMBRES no coinciden con el formato solicitado!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        };
        /* apellidos */
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,200}", $apellidos)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "Los APELLIDOS no coinciden con el formato solicitado!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        };
        /* nombre de usaurio */
        if (mainModel::verificar_datos("^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ_]{3,80}$", $usuarioName)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "El USERNAME no coincide con el formato solicitado!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        };
        /* contraseñas */
        if (
            mainModel::verificar_datos("[A-Za-zÁÉÍÓÚáéíóúÑñ0-9@$!%*?&._#\]{3,255}", $password) ||
            mainModel::verificar_datos("[A-Za-zÁÉÍÓÚáéíóúÑñ0-9@$!%*?&._#\]{3,255}", $password_confirm)
        ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "Las Contraseñas no coinciden con el formato solicitado!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        };


        /* comprobar que no hayan datos repetidos  */
        /* nombre de usuario */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT us_username FROM usuarios WHERE us_username = '$usuarioName'");
        if ($check_usuario->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "El USUARIO ya se encuentra registrado, por favor ingrese otro!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        };
        /* comprobar correo */
        if ($correo != "") {
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $check_correo = mainModel::ejecutar_consulta_simple("SELECT us_correo FROM usuarios WHERE us_correo = '$correo'");
                if ($check_correo->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "ocurrio un error inesperado",
                        "texto" => "El correo ya se encuentra registrado, por favor ingrese otro!",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                };
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "ocurrio un error inesperado",
                    "texto" => "Has ingresado un correo no valido!",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        /* comprobar contraseñas */

        if ($password != $password_confirm) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "Las CONTRASEÑAS no coinciden, intente nuevamente!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
        };

        $datos_usuario_reg = [
            "Nombres" => $nombres,
            "Apellidos" => $apellidos,
            "Correo" => $correo,
            "UsuarioName" => $usuarioName,
            "Password" => $password_hash
        ];
        $agregar_usuario = userModel::agregar_usuario_modelo($datos_usuario_reg);

        if ($agregar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Usuario registrado correctamente",
                "texto" => "El USUARIO se ha registrado con exito",
                "Tipo" => "success"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "No se ha podido registrar el usuario, por favor intente nuevamente!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    }
    /* -----------------------------------controlador para paginar usuarios------------------------------------------ */
    public function paginado_user_controller($pagina, $registros, $privilegio, $id, $url, $busqueda)
    {
        /* limpiamos cadenas para evitar injeccion */
        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $privilegio = mainModel::limpiar_cadena($privilegio);
        $id = mainModel::limpiar_cadena($id);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVER_URL . $url . "/";
        $busqueda = mainModel::limpiar_cadena($busqueda);

        $tabla = "";

        /* validamos que el valor ingresado por url sea un numero */
        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            /* busqueda */
            $consulta = "
                SELECT 
                    SQL_CALC_FOUND_ROWS 
                    u.*
                FROM usuarios AS u
                WHERE (u.us_id != '$id' AND u.us_id != '5')
                AND (
                    u.us_nombres LIKE '%$busqueda%' OR
                    u.us_apellidos LIKE '%$busqueda%' OR
                    u.us_telefono LIKE '%$busqueda%' OR
                    u.us_correo LIKE '%$busqueda%' OR
                    u.us_direccion LIKE '%$busqueda%' OR
                    u.us_username LIKE '%$busqueda%'
                )
                ORDER BY u.us_nombres ASC 
                LIMIT $inicio, $registros
            ";
        } else {
            /* evitamos que el usuario actual y el usuario principal sean visibles y accesibles */
            $consulta = "
                SELECT 
                    SQL_CALC_FOUND_ROWS 
                    u.*
                FROM usuarios AS u
                WHERE u.us_id != '$id' 
                AND u.us_id != '5'
                ORDER BY u.us_nombres ASC 
                LIMIT $inicio, $registros
            ";
        }

        /* realizamos la peticion a la base de datos */
        $conexion = mainModel::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        /* obtenemos la cantidad total de registro */
        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        /* numero de paginas por registros */
        $Npaginas = ceil($total / $registros);

        /* inicio de tabla */
        $tabla .= '
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>NOMBRES</th>
                                <th>APELLIDO PATERNO</th>
                                <th>APELLIDO MATERMNO</th>
                        <th>TELEFONO</th>
                        <th>CORREO</th>
                        <th>DIRECCION</th>
                        <th>NOMBRE DE USUARIO</th>
                        <th>CREADO EN</th>
                        <th>ACTUALIZADO EN</th>
                                <th>
                                    ACCIONES
                                </th>
                            </tr>
                        </thead>
                        <tbody>
        ';

        if ($pagina <= $Npaginas && $total >= 1) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '
                    <tr>
                        <td>' . $contador . '</td>
                        <td>' . $rows["us_nombres"] . '</td>
                        <td>' . $rows["us_apellidos"] . '</td>
                        <td>' . $rows["us_telefono"] . '</td>
                        <td>' . $rows["us_correo"] . '</td>
                        <td>' . $rows["us_direccion"] . '</td>
                        <td>' . $rows["us_username"] . '</td>
                        <td>' . $rows["us_creado_en"] . '</td>
                        <td>' . $rows["us_actualizado_en"] . '</td>
                        <td><a href="' . SERVER_URL . 'usuarioActualizar/' . mainModel::encryption($rows['us_id']) . '/" class="btn-editar">Editar</a></td>
                    </tr>
                ';
                $contador++;
            }
            $reg_final =  $contador - 1;
        } else {


            if ($total >= 1) {
                /* en caso que la url no sea valida de una pagina con registros mostrara  */
                $tabla .= ' <tr><td colspan="15">  <a class="btn-primary" href="' . $url . '"> Recargar </a></td></tr> ';
            } else {
                /* en caso que no tenga registrados ni un registro en la base de datos mostrara  */
                $tabla .= ' <tr><td colspan="15"> No hay registros</td></tr> ';
            }
        }

        /* final de talbla */
        $tabla .= '
                </tbody>
            </table>
        </div>
        
        ';

        if ($pagina <= $Npaginas && $total >= 1) {
            $tabla .= '<p> Mostrando registros ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . ' </p>';
            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 5);
        }

        /* devolvemos tabla */
        return $tabla;
    }


    /* -----------------------------------controlador para desabilitar usuarios------------------------------------------ */
    public function disable_user_controller()
    {
        /* resibimos el id del usuario que qeremos desabilitar */
        $id = mainModel::decryption($_POST['usuario_des']);
        $id = mainModel::limpiar_cadena($id);
        /*  el id no debe ser ugual al id del usuario principal */
        if ($id == 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "Este usuario no puede ser desabilitado!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "ocurrio un error inesperado",
            "texto" => "La función de deshabilitar usuarios ha sido eliminada en esta versión del sistema!",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }



    /* -----------------------------------controlador para actualizar datos de usuarios------------------------------------------ */
    public function data_update_user_controller()
    {
        
        $id = mainModel::decryption($_POST['usuario_id_up']);
        $id = mainModel::limpiar_cadena($id);

        /* asignamos los campos  del formulario*/

        $nombres = mainModel::limpiar_cadena($_POST['Nombres_up']);
        $apellidos = mainModel::limpiar_cadena($_POST['Apellidos_up']);
        $carnet = mainModel::limpiar_cadena($_POST['Carnet_up']);
        $telefono = mainModel::limpiar_cadena($_POST['Telefono_up']);
        $correo = mainModel::limpiar_cadena($_POST['Correo_up']);
        $direccion = mainModel::limpiar_cadena($_POST['Direccion_up']);

        /* campos de confirmacion de cambios */
        $username = mainModel::limpiar_cadena($_POST['UsuarioName_up']);
        $password = mainModel::limpiar_cadena($_POST['Password_up']);
        $admin_usuario = mainModel::limpiar_cadena($_POST['Usuario_confirm']);
        $admin_password = mainModel::limpiar_cadena($_POST['Password_confirm']);;
        $tipo_cuenta = mainModel::limpiar_cadena($_POST['Tipo_up']);
        /* verificamos que los campos obligatorios no esten vacios */

        if ($nombres == "" || $apellidos == "" || $carnet == "" || $username == "" || $admin_usuario == "" || $admin_password == "") {
                /* si algun campo esta basio */;
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "No se han llenado todos los campos obligatorios!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* verificar la integridad de los datos (patern) */
        /* nombres */
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,100}", $nombres)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "El NOMBRE no coincide con el formato solicitado!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        };
        /* apellidos */
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,100}", $apellidos)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "Los APELLIDOS no coinciden con el formato solicitado!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        };
        /* numero de carnet */
        if (mainModel::verificar_datos("[0-9]{6,20}", $carnet)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "El Carnet no coincide con el formato solicitado!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        };
        /* telefono vacio */
        if ($telefono != "") {
            if (mainModel::verificar_datos("[0-9]{6,20}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "ocurrio un error inesperado",
                    "texto" => "El Telefono no coincide con el formato solicitado!",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            };
        };
        /* nombre de usaurio */
        if (mainModel::verificar_datos("^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ_]{3,100}$", $username)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "El USERNAME no coincide con el formato solicitado!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        };
        /* usuario de confirmacion */
        if (mainModel::verificar_datos("^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ_]{3,100}$", $admin_usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "Tu nombre de USUARIO no coincide con el formato solicitado!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        };/* contraseña de confirmacion */
        if (mainModel::verificar_datos("^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ_]{3,100}$", $admin_password)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "Tu contraseña no coincide con el formato solicitado!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        };
        /* encriptamos la contrseña de confirmacion */
        $admin_password = mainModel::encryption($admin_password);



        /* validamos contraseñas para actualizar (cambair contraseñas)  */
        if ($_POST['Password_up'] != "" && $_POST['PasswordConfirm_up'] != "") {
            if ($_POST['Password_up'] != $_POST['PasswordConfirm_up']) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "ocurrio un error inesperado",
                    "texto" => "Las nuevas contraseñas no coinciden!",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                if (mainModel::verificar_datos("[A-Za-zÁÉÍÓÚáéíóúÑñ0-9@$!%*?&._#]{3,100}", $_POST['Password_up'])  || mainModel::verificar_datos("[A-Za-zÁÉÍÓÚáéíóúÑñ0-9@$!%*?&._#]{3,100}", $_POST['PasswordConfirm_up'])) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "ocurrio un error inesperado",
                        "texto" => "Las nuevas contraseñas no coinciden con el formato solicitado!",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
                $password = mainModel::encryption($_POST['Password_up']);
            }
        }

        /* comprovar credenciales para actualizar datos de usuarios */
        if ($tipo_cuenta == "Propia") {
            $check_cuenta = mainModel::ejecutar_consulta_simple(
                "SELECT us_id FROM usuarios 
            WHERE
            us_username = '$admin_usuario' AND
            us_password_hash = '$admin_password' AND
            us_id = '$id'"
            );
        } else {
            session_start(['name' => 'SMP']);
            if ($_SESSION['rol_smp'] != 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "ocurrio un error inesperado",
                    "texto" => "Nocuentas con los permisos necesarios!",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $check_cuenta = mainModel::ejecutar_consulta_simple("SELECT us_id FROM usuarios WHERE us_username = '$admin_usuario' AND us_password_hash = '$admin_password'");
        }
        /* contar si hay registros */

        if ($check_cuenta->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "Las credenciales de administrador no existen dentro del sistema!",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* preparamos los datos para su registro en la base de datos  */


        $datos_usuario_up = [
            "Nombres" => $nombres,
            "Apellidos" => $apellidos,
            "Carnet" => $carnet,
            "Telefono" => $telefono,
            "Correo" => $correo,
            "Direccion" => $direccion,
            "UsuarioName" => $username,
            "Password" => $password,
            "Id" => $id
        ];

        if (userModel::data_update_user_model($datos_usuario_up)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Actualizado correctamente",
                "texto" => "Se alctualizo la informacion del usuario correctamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "texto" => "No se pudo actualizar el usuario, intente nuevamente mas tarde!",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /* -----------------------------------controlador para paginar usuarios------------------------------------------ */
    /* -----------------------------------controlador para paginar usuarios------------------------------------------ */
    /* -----------------------------------controlador para paginar usuarios------------------------------------------ */
    /* -----------------------------------controlador para paginar usuarios------------------------------------------ */
    /* -----------------------------------controlador para paginar usuarios------------------------------------------ */
    /* -----------------------------------controlador para paginar usuarios------------------------------------------ */
}
