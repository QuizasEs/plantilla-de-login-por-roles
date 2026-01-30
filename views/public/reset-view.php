<div class="login-container">
    <div class="slider-container">
        <div class="slides-container">
            <div class="slide"><img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Slide 1"></div>
            <div class="slide"><img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Slide 2"></div>
            <div class="slide"><img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Slide 3"></div>
            <div class="slide"><img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Slide 4"></div>
        </div>
    </div>

    <div class="form-login-content">
        <div class="text-center">
            <img src="<?php echo SERVER_URL; ?>views/image/background-logo.png" alt="Logo" class="logo-login">
        </div>
        <h2 class="title-login">RECUPERAR CONTRASEÑA</h2>

        <?php
        session_start(['name' => 'SMP']);
        if (isset($_GET['step']) && $_GET['step'] == 'code') {
            if (!isset($_SESSION['email_enviado'])) {
                header("Location: " . SERVER_URL . "?view=reset");
                exit();
            }
        }
        if (isset($_GET['step']) && $_GET['step'] == 'password') {
            if (!isset($_SESSION['codigo_verificado'])) {
                header("Location: " . SERVER_URL . "?view=reset&step=code");
                exit();
            }
        }
        ?>

        <?php if (!isset($_GET['step']) || $_GET['step'] == 'email'): ?>
            <p style="color: white; text-align: center; margin-bottom: 20px;">Ingresa tu correo electrónico para recibir un código de recuperación.</p>
            <?php if (isset($_GET['error'])): ?>
                <?php if ($_GET['error'] == 'correo_invalido'): ?>
                    <p style="color: red; text-align: center;">Correo inválido.</p>
                <?php elseif ($_GET['error'] == 'correo_no_encontrado'): ?>
                    <p style="color: red; text-align: center;">Correo no encontrado.</p>
                <?php endif; ?>
            <?php endif; ?>
            <form action="<?php echo SERVER_URL; ?>ajax/process_reset.php" class="form-login" method="POST">
                <div class="bloque-login">
                    <label for="" class="login">CORREO ELECTRÓNICO</label>
                    <input type="email" name="email_reset" required>
                </div>
                <button type="submit" class="btn-primary">ENVIAR CÓDIGO</button>
            </form>
        <?php elseif ($_GET['step'] == 'code'): ?>
            <p style="color: white; text-align: center; margin-bottom: 20px;">Ingresa el código de verificación enviado a tu correo.</p>
            <?php if (isset($_GET['error']) && $_GET['error'] == 'codigo_incorrecto'): ?>
                <p style="color: red; text-align: center;">Código incorrecto.</p>
            <?php endif; ?>
            <form action="<?php echo SERVER_URL; ?>ajax/process_reset.php" class="form-login" method="POST">
                <div class="bloque-login">
                    <label for="" class="login">CÓDIGO DE VERIFICACIÓN</label>
                    <input type="text" name="codigo_verificar" maxlength="6" required>
                </div>
                <button type="submit" class="btn-primary">VERIFICAR CÓDIGO</button>
            </form>
        <?php elseif ($_GET['step'] == 'password'): ?>
            <p style="color: white; text-align: center; margin-bottom: 20px;">Ingresa tu nueva contraseña.</p>
            <?php if (isset($_GET['error'])): ?>
                <?php if ($_GET['error'] == 'verificacion_requerida'): ?>
                    <p style="color: red; text-align: center;">Verificación requerida.</p>
                <?php elseif ($_GET['error'] == 'contraseñas_diferentes'): ?>
                    <p style="color: red; text-align: center;">Las contraseñas no coinciden.</p>
                <?php elseif ($_GET['error'] == 'formato_invalido'): ?>
                    <p style="color: red; text-align: center;">Formato inválido.</p>
                <?php elseif ($_GET['error'] == 'contraseña_igual'): ?>
                    <p style="color: red; text-align: center;">La nueva contraseña no puede ser igual a la actual.</p>
                <?php elseif ($_GET['error'] == 'sesion_expirada'): ?>
                    <p style="color: red; text-align: center;">Sesión expirada.</p>
                <?php endif; ?>
            <?php endif; ?>
            <form action="<?php echo SERVER_URL; ?>ajax/process_reset.php" class="form-login" method="POST">
                <div class="bloque-login">
                    <label for="" class="login">NUEVA CONTRASEÑA</label>
                    <input type="password" name="password" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9@$!%*?&._#]{3,100}" required>
                </div>
                <div class="bloque-login">
                    <label for="" class="login">CONFIRMAR CONTRASEÑA</label>
                    <input type="password" name="confirm_password" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9@$!%*?&._#]{3,100}" required>
                </div>
                <button type="submit" class="btn-primary">CAMBIAR CONTRASEÑA</button>
            </form>
        <?php endif; ?>

        <a href="<?php echo SERVER_URL; ?>?view=login" style="color: white; text-decoration: none;">Volver al login</a>
    </div>
</div>