<?php
if ($_SESSION['rol_smp'] != 1) {/* preguntamos que si el que intenta entrar a esta vista tien un privilegio distinto de admin que sierre su sesio */
    echo $lc->forzar_cierre_sesion_controller();
    exit();
}
require_once "./controllers/userController.php";
/* instanciamos controlador usuariosS */
$ins_usuario = new userController();

?>
<div class="title">
    <h1>Registro de usuarios</h1>
</div>
<!-- formulario de registro de usuarios -->
<div class="registro-usaurios-container">
    <form class="form-registro-usuario FormularioAjax" action="<?php echo SERVER_URL; ?>ajax/userAjax.php" method="POST" data-form="save" autocomplete="off">


        <!-- DATOS DEL USUARIO -->
        <div class="form-title">
            <h3>datos del usuario</h3>
        </div>
        <div class="form-group">
            <div class="form-bloque">
                <label for="">NOMBRES*</label>
                <input type="text" name="Nombres_reg" placeholder="ingresar nombres" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,120}" maxlength="120" required>
            </div>
            <div class="form-bloque">
                <label for="">APELLIDOS*</label>
                <input type="text" name="Apellidos_reg" placeholder="ingresar apellidos" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,200}" maxlength="200" required>
            </div>
        </div>

        <div class="form-group">
            <div class="form-bloque">
                <label for="">CORREO ELECTRÓNICO</label>
                <input type="email" name="Correo_reg" maxlength="120" placeholder="ingresar correo electrónico">
            </div>
            <div class="form-bloque">
                <label for="">NOMBRE DE USUARIO*</label>
                <input type="text" name="UsuarioName_reg" pattern="^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ_]{3,80}$" maxlength="80" placeholder="ingresar nombre de usuario" required>
            </div>
        </div>

        <div class="form-group">
            <div class="form-bloque">
                <label for="">CONTRASEÑA*</label>
                <input type="password" name="Password_reg" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9@$!%*?&._#\]{3,255}" maxlength="255" placeholder="ingresar contraseña" required>
            </div>
            <div class="form-bloque">
                <label for="">CONFIRMAR CONTRASEÑA*</label>
                <input type="password" name="PasswordConfirm_reg" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9@$!%*?&._#\]{3,255}" maxlength="255" placeholder="confirmar contraseña" required>
            </div>
        </div>
        <div class="form-buttons">
            <button class="btn-primary">Agregar</button>
        </div>
    </form>
</div>