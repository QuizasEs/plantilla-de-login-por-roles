<?php
require_once "mainModel.php";

class resetModel extends mainModel {
    /* Modelo para enviar token de recuperación */
    protected static function enviar_token_model($email) {
        $sql = mainModel::conectar()->prepare("SELECT us_id, us_username FROM usuarios WHERE us_correo = :Email");
        $sql->bindParam(":Email", $email);
        $sql->execute();
        return $sql;
    }

    /* Modelo para guardar token */
    protected static function guardar_token_model($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE usuarios SET us_token_recuperacion = :Token, us_token_expiracion = :Expiracion WHERE us_id = :Id");
        $sql->bindParam(":Token", $datos['token']);
        $sql->bindParam(":Expiracion", $datos['expiracion']);
        $sql->bindParam(":Id", $datos['id']);
        $sql->execute();
        return $sql;
    }

    /* Modelo para verificar token */
    protected static function verificar_token_model($token) {
        $sql = mainModel::conectar()->prepare("SELECT us_id FROM usuarios WHERE us_token_recuperacion = :Token AND us_token_expiracion > NOW()");
        $sql->bindParam(":Token", $token);
        $sql->execute();
        return $sql;
    }

    /* Modelo para obtener contraseña actual */
    protected static function get_current_password_model($id) {
        $sql = mainModel::conectar()->prepare("SELECT us_password_hash FROM usuarios WHERE us_id = :Id");
        $sql->bindParam(":Id", $id);
        $sql->execute();
        return $sql;
    }

    /* Modelo para cambiar contraseña */
    protected static function cambiar_password_model($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE usuarios SET us_password_hash = :Password, us_token_recuperacion = NULL, us_token_expiracion = NULL WHERE us_id = :Id");
        $sql->bindParam(":Password", $datos['password']);
        $sql->bindParam(":Id", $datos['id']);
        $sql->execute();
        return $sql;
    }
}
?>