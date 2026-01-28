<?php
require_once "mainModel.php";

class userModel extends mainModel
{



    /* -------------------------------registrar usuario----------------------------------- */
    protected static function agregar_usuario_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("
        INSERT INTO usuarios(
            us_nombres, 
            us_apellidos, 
            us_correo, 
            us_username, 
            us_password_hash
        ) VALUES(
            :nombres, 
            :apellidos, 
            :correo, 
            :username, 
            :password
        )
    ");

        $sql->bindParam(":nombres", $datos['Nombres']);
        $sql->bindParam(":apellidos", $datos['Apellidos']);
        $sql->bindParam(":correo", $datos['Correo']);
        $sql->bindParam(":username", $datos['UsuarioName']);
        $sql->bindParam(":password", $datos['Password']);

        $sql->execute();
        return $sql;
    }

    /* -------------------------------desabilitar usuario usuario----------------------------------- */

    /* ------------------------------ obtener datos de usuario----------------------------------- */

    protected static function data_user_model($tipo, $id)
    {
        /* para cuando el usuario quiere ver su propio perfil */
        if ($tipo == "Unico") {
            $sql = mainModel::Conectar()->prepare("SELECT * FROM usuarios WHERE us_id = :ID");
            $sql->bindParam(":ID", $id);
        } else if ($tipo == "Conteo") {
            /* contamos todos los registros de la base de datos exeptuendo el usuario principal */
            $sql = mainModel::conectar()->prepare("SELECT us_id FROM usuarios WHERE us_id != '1'");
        }
        $sql->execute();
        return $sql;
    }





    /* ------------------------------ modelo para actualizar los datos de usuario----------------------------------- */
    protected static function data_update_user_model($datos)
    {
        $sql = mainModel::conectar()->prepare("UPDATE usuarios 
        SET 
        us_nombres = :nombres, 
        us_apellidos = :apellidos,
        us_correo = :correo,
        us_username = :username,
        us_password_hash = :password
        WHERE us_id = :id
        ");
        $sql->bindParam(":nombres", $datos['Nombres']);
        $sql->bindParam(":apellidos", $datos['Apellidos']);
        $sql->bindParam(":correo", $datos['Correo']);
        $sql->bindParam(":username", $datos['UsuarioName']);
        $sql->bindParam(":password", $datos['Password']);
        $sql->bindParam(":id", $datos['Id']);
        $sql->execute();
        return $sql;
    }


    /* ------------------------------ usuario usuario----------------------------------- */
    /* ------------------------------ usuario usuario----------------------------------- */
    /* ------------------------------ usuario usuario----------------------------------- */
    /* ------------------------------ usuario usuario----------------------------------- */
    /* ------------------------------ usuario usuario----------------------------------- */
    /* ------------------------------ usuario usuario----------------------------------- */
    /* ------------------------------ usuario usuario----------------------------------- */
}
