<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['producto_titulo_reg']) || isset($_POST['producto_id_up']) || isset($_POST['producto_id_del']) || isset($_POST['producto_id_get']) || isset($_POST['pagina'])) {

    require_once "../controllers/productoController.php";
    $ins_producto = new productoController();

    /*----------  Registrar producto  ----------*/
    if (isset($_POST['producto_titulo_reg'])) {
        echo $ins_producto->agregar_producto_controlador();
    }

    /*----------  Listar productos  ----------*/
    if (isset($_POST['pagina'])) {
        echo $ins_producto->listar_productos_controlador($_POST['pagina'], 10, $_POST['busqueda']);
    }

    /*----------  Obtener datos producto  ----------*/
    if (isset($_POST['producto_id_get'])) {
        $_POST['producto_id'] = $_POST['producto_id_get'];
        echo $ins_producto->obtener_producto_controlador();
    }

    /*----------  Actualizar producto  ----------*/
    if (isset($_POST['producto_id_up'])) {
        $_POST['producto_id'] = $_POST['producto_id_up'];
        echo $ins_producto->actualizar_producto_controlador();
    }

    /*----------  Eliminar producto  ----------*/
    if (isset($_POST['producto_id_del'])) {
        $_POST['producto_id'] = $_POST['producto_id_del'];
        echo $ins_producto->eliminar_producto_controlador();
    }

} else {
    session_start(['name' => 'SMP']);
    session_unset();
    session_destroy();
    header("Location: " . SERVER_URL . "login/");
    exit();
}
