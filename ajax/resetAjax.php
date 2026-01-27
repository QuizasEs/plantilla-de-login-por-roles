<?php
// Forzamos la salida del contenido como JSON (esto evita errores de parseo en el frontend)
header('Content-Type: application/json; charset=utf-8');

require_once "../config/APP.php";
$peticionAjax = true;
require_once "../controllers/resetController.php";

$reset = new resetController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email_reset'])) {
        $reset->solicitar_recuperacion_controller();
    } elseif (isset($_POST['codigo_verificar'])) {
        $reset->verificar_codigo_controller();
    } elseif (isset($_POST['password'])) {
        $reset->cambiar_password_controller();
    }
}
?>