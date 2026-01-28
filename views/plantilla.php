<!DOCTYPE html>
<html lang="en">

<?php include "inc/head.php"; ?>

<?php
    $peticionAjax = false;
    require_once __DIR__ . "/../controllers/viewsController.php";

    $IV = new viewsController();
    $vistas = $IV->get_views_controller();

    if ($vistas == "login" || $vistas == "404" || $vistas == "reset" || $vistas == "home"): ?>
<body>
<?php else: ?>
<body class="dark">
<?php endif; ?>

    <?php if ($vistas == "login" || $vistas == "404" || $vistas == "reset" || $vistas == "home") {
        if($vistas == "home"){
            require_once "./views/public/home-view.php";
        }else{
            require_once "./views/public/" . $vistas . "-view.php";
        }
    } else {
        /* inicializa sesion */
        session_start(['name' => 'SMP']);
        require_once "./controllers/loginController.php";
        $lc = new loginController();
        if (
            !isset($_SESSION['token_smp']) ||
            !isset($_SESSION['apellido_paterno_smp']) ||
            !isset($_SESSION['apellido_materno_smp']) ||
            !isset($_SESSION['nombre_smp']) ||
            !isset($_SESSION['usuario_smp'])
        ) {
            echo $lc->forzar_cierre_sesion_controller();
            exit();
        }
    ?>
        <main>
            <!---------------------------------------------sidebar--------------------------------------------------->
            <?php include_once "inc/sidebar.php"; ?>
            <!---------------------------------------------navbar--------------------------------------------------->
            <?php include_once "inc/navbar.php"; ?>
            <!---------------------------------------------Cuerpo principal--------------------------------------------------->
            <?php 
            /* iniciamos controller usuario */
            require_once "./controllers/userController.php";
            $ins_usuario = new userController();
            ?>
            <div class="main-content">
                <div class="container-fluid p-3 p-md-4">
                    <!--------------------------------------------- contenido de platillas y vistas--------------------------------------------------->
                    <?php include_once $vistas; ?>
                </div>
            </div>

        </main>


        <!---------------- -----------------------------Script--------------------------------------------------->

    <?php
        include_once "inc/logOut.php";
    }
    include_once "inc/script.php";


    /* include_once "inc/footer.php"; */
    ?>

</body>

</html>