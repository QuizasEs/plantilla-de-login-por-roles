<?php
require_once "mainModel.php";

class productoModel extends mainModel
{
    /*----------  Modelo agregar producto  ----------*/
    protected static function agregar_producto_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO productos(pro_titulo, pro_imagen_principal, pro_imagen_secundaria1, pro_imagen_secundaria2, pro_imagen_secundaria3, pro_descripcion, pro_puntaje, pro_precio, pro_link_video) VALUES(:titulo, :imagen_principal, :imagen_secundaria1, :imagen_secundaria2, :imagen_secundaria3, :descripcion, :puntaje, :precio, :link_video)");

        $sql->bindParam(":titulo", $datos['titulo']);
        $sql->bindParam(":imagen_principal", $datos['imagen_principal']);
        $sql->bindParam(":imagen_secundaria1", $datos['imagen_secundaria1']);
        $sql->bindParam(":imagen_secundaria2", $datos['imagen_secundaria2']);
        $sql->bindParam(":imagen_secundaria3", $datos['imagen_secundaria3']);
        $sql->bindParam(":descripcion", $datos['descripcion']);
        $sql->bindParam(":puntaje", $datos['puntaje']);
        $sql->bindParam(":precio", $datos['precio']);
        $sql->bindParam(":link_video", $datos['link_video']);

        $sql->execute();
        return $sql;
    }

    /*----------  Modelo listar productos  ----------*/
    protected static function listar_productos_modelo($inicio, $registros, $busqueda)
    {
        if ($busqueda != "") {
            $consulta = "SELECT * FROM productos WHERE pro_titulo LIKE '%$busqueda%' OR pro_descripcion LIKE '%$busqueda%' ORDER BY pro_titulo ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT * FROM productos ORDER BY pro_titulo ASC LIMIT $inicio, $registros";
        }
        return mainModel::conectar()->query($consulta);
    }

    /*----------  Modelo contar productos  ----------*/
    protected static function contar_productos_modelo($busqueda)
    {
        if ($busqueda != "") {
            $consulta = "SELECT COUNT(pro_id) FROM productos WHERE pro_titulo LIKE '%$busqueda%' OR pro_descripcion LIKE '%$busqueda%'";
        } else {
            $consulta = "SELECT COUNT(pro_id) FROM productos";
        }
        return mainModel::conectar()->query($consulta)->fetchAll();
    }

    /*----------  Modelo obtener producto  ----------*/
    protected static function obtener_producto_modelo($id)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM productos WHERE pro_id = :id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql;
    }

    /*----------  Modelo actualizar producto  ----------*/
    protected static function actualizar_producto_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("UPDATE productos SET pro_titulo = :titulo, pro_imagen_principal = :imagen_principal, pro_imagen_secundaria1 = :imagen_secundaria1, pro_imagen_secundaria2 = :imagen_secundaria2, pro_imagen_secundaria3 = :imagen_secundaria3, pro_descripcion = :descripcion, pro_puntaje = :puntaje, pro_precio = :precio, pro_link_video = :link_video, pro_fecha_actualizacion = NOW() WHERE pro_id = :id");

        $sql->bindParam(":titulo", $datos['titulo']);
        $sql->bindParam(":imagen_principal", $datos['imagen_principal']);
        $sql->bindParam(":imagen_secundaria1", $datos['imagen_secundaria1']);
        $sql->bindParam(":imagen_secundaria2", $datos['imagen_secundaria2']);
        $sql->bindParam(":imagen_secundaria3", $datos['imagen_secundaria3']);
        $sql->bindParam(":descripcion", $datos['descripcion']);
        $sql->bindParam(":puntaje", $datos['puntaje']);
        $sql->bindParam(":precio", $datos['precio']);
        $sql->bindParam(":link_video", $datos['link_video']);
        $sql->bindParam(":id", $datos['id']);

        $sql->execute();
        return $sql;
    }

    /*----------  Modelo eliminar producto  ----------*/
    protected static function eliminar_producto_modelo($id)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM productos WHERE pro_id = :id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql;
    }
}
