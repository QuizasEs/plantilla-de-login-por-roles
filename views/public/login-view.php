            <!---------------------------------------------login--------------------------------------------------->
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
                    <form action="" class="form-login" method="POST">
                        <h2 class="title-login">LOGIN</h2>
                        <div class="bloque-login">
                            <label for="" class="login">NOMBRE DE USUARIOS</label>
                            <input type="text" name="Usuario_log" pattern="^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ_]{3,100}" maxlength="100"  required>
                        </div>
                        <div class="bloque-login">
                            <label for="" class="login">CONTRASEÑA</label>
                            <input type="password" name="Password_log" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9@$!%*?&._#\]{3,100}" maxlength="100"  required>
                        </div>
                        <button class="btn-primary">ACEPTAR</button>
                        <a href="<?php echo SERVER_URL; ?>?view=reset" style="color: white; text-decoration: none;">¿Olvidaste tu contraseña?</a>
                    </form>
                </div>
            </div>
            <?php 
                if(isset($_POST['Usuario_log']) && isset($_POST['Password_log'])){
                    require_once "./controllers/loginController.php";
                    $ins_login = new loginController();
                    echo $ins_login->iniciar_sesion_controller();
                }
            ?>