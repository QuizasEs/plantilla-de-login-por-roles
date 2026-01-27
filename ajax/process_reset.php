<?php

$peticionAjax = false;

require_once "../config/APP.php";

require_once "../controllers/resetController.php";

$reset = new resetController();

if (isset($_POST['email_reset'])) {
    $reset->solicitar_recuperacion_controller();
} elseif (isset($_POST['codigo_verificar'])) {
    $reset->verificar_codigo_controller();
} elseif (isset($_POST['password'])) {
    $reset->cambiar_password_controller();
}

?>