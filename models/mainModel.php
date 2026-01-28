<?php
/* preguntamos si se realiza una peticion ajax o no */
if (!isset($peticionAjax)) {
    $peticionAjax = false;
}
require_once __DIR__ . "/../config/SERVER.php";

/* -------------------------------------------------clase principal main model------------------------------------- */
class mainModel
{

    /* ------------------funcion de conexion a la base de datos usandos variables de SERVER.php ----------------*/
    protected static function Conectar()
    {
        try {
            $conexion = new PDO(SGBD . ";charset=utf8mb4", USER, PASS);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            die("❌ Error de conexión: " . $e->getMessage());
        }
    }


    /* ----------------------------------------funcion que ejecuta consultas simples---------------------------------------------- */
    protected static function ejecutar_consulta_simple($consulta)
    {
        $sql = self::conectar()->prepare($consulta);
        $sql->execute();
        return $sql;
    }

    /* ---------------------------------------funcion de encriptado---------------------------------------------- */
    public function encryption($string)
    {
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }
    /* -------------------------------------- funcion de desncritar------------------------------------------------ */
    protected static function decryption($string)
    {
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }
    /* -------------------------------------genera codigos aleatorios------------------------------------------------- */
    protected static function generar_codigo_aleatorio($letra, $longitud, $numero)
    {
        for ($i = 0; $i < $longitud; $i++) {
            $aleatorio = rand(0, 9);
            $letra .= $aleatorio;
        }
        return $letra . "-" . $numero;
    }

    /* ----------------------------------------funcion para limpiar cadenas---------------------------------------------- */
    protected static function limpiar_cadena($cadena)
    {
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src", "", $cadena);
        $cadena = str_ireplace("<script type=", "", $cadena);
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("DROP TABLE", "", $cadena);
        $cadena = str_ireplace("DROP DATABASE", "", $cadena);
        $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
        $cadena = str_ireplace("SHOW TABLES", "", $cadena);
        $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
        $cadena = str_ireplace("<?php", "", $cadena);
        $cadena = str_ireplace("?>", "", $cadena);
        $cadena = str_ireplace("--", "", $cadena);
        $cadena = str_ireplace(">", "", $cadena);
        $cadena = str_ireplace("<", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("^", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace(";", "", $cadena);
        $cadena = str_ireplace("::", "", $cadena);
        $cadena = stripslashes($cadena);
        $cadena = trim($cadena);
        return $cadena;
    }
    /* --------------------------------------funcion que verifica los datos------------------------------------------------ */
    protected static function verificar_datos($filtro, $cadena)
    {
        if (preg_match("/^" . $filtro . "$/", $cadena)) {
            return false;
        } else {
            return true;
        }
    }

    /* -----------------------------------funcion para verificar las fechas --------------------------------------------------- */
    protected static function verificar_fecha($fecha)
    {
        $valor = explode('-', $fecha);
        if ((count($valor)) == 3 && checkdate($valor[1], $valor[2], $valor[0])) {
            return false;
        } else {
            return true;
        }
    }
    /* -----------------------------------------funcion paginador de tablas--------------------------------------------- */
    protected static function paginador_tablas($pagina, $Npaginas, $url, $botones)
    {
        $tabla = '<nav aria-label="Page navigation example" class="pagination-container">
                    <ul class="pagination justify-content-center flex-wrap">';

        // Botón "Anterior" y "<<" (flecha doble izquierda)
        if ($pagina == 1) {
            $tabla .= '<li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-hidden="true">
                            <ion-icon name="chevron-back-circle-outline"></ion-icon>
                        </span>
                      </li>';
        } else {
            $tabla .= '<li class="page-item">
                        <a class="page-link pagination-link" href="#" data-page="' . ($pagina - 1) . '" aria-label="Anterior">
                            <ion-icon name="chevron-back-circle-outline"></ion-icon>
                        </a>
                      </li>';
        }

        // Calcular el rango de números de página a mostrar (máximo 5)
        $rango = 5;
        $mitad = floor($rango / 2);
        
        // Determinar el inicio y fin del rango
        if ($Npaginas <= $rango) {
            // Si hay pocas páginas, mostrar todas
            $inicio = 1;
            $fin = $Npaginas;
        } else {
            // Si hay muchas páginas, centrar en la página actual
            $inicio = $pagina - $mitad;
            $fin = $pagina + $mitad;
            
            // Ajustar si nos salimos de los límites
            if ($inicio < 1) {
                $fin = $fin + (1 - $inicio);
                $inicio = 1;
            }
            if ($fin > $Npaginas) {
                $inicio = $inicio - ($fin - $Npaginas);
                $fin = $Npaginas;
                if ($inicio < 1) {
                    $inicio = 1;
                }
            }
        }

        // Mostrar números de página
        for ($i = $inicio; $i <= $fin; $i++) {
            if ($pagina == $i) {
                $tabla .= '<li class="page-item active" aria-current="page">
                            <span class="page-link">
                                ' . $i . '
                                <span class="sr-only">(current)</span>
                            </span>
                          </li>';
            } else {
                $tabla .= '<li class="page-item">
                            <a class="page-link pagination-link" href="#" data-page="' . $i . '">' . $i . '</a>
                          </li>';
            }
        }

        // Botón "Siguiente" y ">>" (flecha doble derecha)
        if ($pagina == $Npaginas) {
            $tabla .= '<li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-hidden="true">
                            <ion-icon name="chevron-forward-circle-outline"></ion-icon>
                        </span>
                      </li>';
        } else {
            $tabla .= '<li class="page-item">
                        <a class="page-link pagination-link" href="#" data-page="' . ($pagina + 1) . '" aria-label="Siguiente">
                            <ion-icon name="chevron-forward-circle-outline"></ion-icon>
                        </a>
                      </li>';
        }

        $tabla .= '</ul></nav>';
        return $tabla;
    }

    
    /* ------------------------------ obtener informacion de sucursales y roles para usuario----------------------------------- */
    protected static function data_rol_list_model($tipo, $id)
    {
        if ($tipo == "Unico") {
            $sql = mainModel::conectar()->prepare("
            SELECT u.us_nombres, r.ro_nombre, r.ro_id   
            FROM roles AS r
            JOIN usuarios AS u ON u.ro_id = r.ro_id 
            WHERE u.us_id = $id;");
        } else if ($tipo == "Multiple") {
            $sql = mainModel::conectar()->prepare("SELECT ro_nombre, ro_id FROM roles WHERE ro_estado = 1");
        }
        $sql->execute();
        return $sql;
    }
    /* -----------------------------------------modelo para obtener sucursales--------------------------------------------- */

    protected static function data_sucursal_list_model($tipo, $id)
    {
        if ($tipo == "Unico") {
            $sql = mainModel::conectar()->prepare("
            SELECT u.us_nombres, s.su_nombre, s.su_id   
            FROM sucursales AS s
            JOIN usuarios AS u ON u.su_id = s.su_id 
            WHERE u.us_id = $id;");
        } else if ($tipo == "Multiple") {
            $sql = mainModel::conectar()->prepare("SELECT su_id, su_nombre FROM sucursales WHERE su_estado = 1");
        }
        $sql->execute();
        return $sql;
    }

    /* -------------------------------------------------------------------------------------- */
    /* -------------------------------------------------------------------------------------- */
    /* -------------------------------------------------------------------------------------- */
    /* -------------------------------------------------------------------------------------- */
    /* -------------------------------------------------------------------------------------- */
    /* -------------------------------------------------------------------------------------- */
    /* -------------------------------------------------------------------------------------- */
    /* -------------------------------------------------------------------------------------- */
}
