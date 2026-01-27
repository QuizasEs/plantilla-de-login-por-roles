<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "../lib/PHPMailer/src/Exception.php";
require_once "../lib/PHPMailer/src/PHPMailer.php";
require_once "../lib/PHPMailer/src/SMTP.php";
require_once "../models/resetModel.php";

class resetController extends resetModel {

    /* Controlador para solicitar recuperación */
    public function solicitar_recuperacion_controller() {
        $email = mainModel::limpiar_cadena($_POST['email_reset']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: " . SERVER_URL . "?view=reset&error=correo_invalido");
            exit();
        }

        $check_email = resetModel::enviar_token_model($email);

        if ($check_email->rowCount() == 1) {
            $row = $check_email->fetch();
            $codigo = sprintf("%06d", mt_rand(0, 999999));
            $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $datos_token = [
                "token" => $codigo,
                "expiracion" => $expiracion,
                "id" => $row['us_id']
            ];

            resetModel::guardar_token_model($datos_token);

            // Enviar email
            $this->enviar_email_recuperacion($email, $codigo, $row['us_username']);

            session_start(['name' => 'SMP']);
            $_SESSION['email_enviado'] = true;

            header("Location: " . SERVER_URL . "?view=reset&step=code");
            exit();
        } else {
            header("Location: " . SERVER_URL . "?view=reset&error=correo_no_encontrado");
            exit();
        }
    }

    /* Controlador para verificar código */
    public function verificar_codigo_controller() {
        $codigo = mainModel::limpiar_cadena($_POST['codigo_verificar']);

        $check_codigo = resetModel::verificar_token_model($codigo);

        if ($check_codigo->rowCount() == 1) {
            $row = $check_codigo->fetch();
            session_start(['name' => 'SMP']);
            $_SESSION['codigo_verificado'] = true;
            $_SESSION['user_id_reset'] = $row['us_id'];

            header("Location: " . SERVER_URL . "?view=reset&step=password");
            exit();
        } else {
            header("Location: " . SERVER_URL . "?view=reset&step=code&error=codigo_incorrecto");
            exit();
        }
    }

    /* Controlador para cambiar contraseña */
    public function cambiar_password_controller() {
        session_start(['name' => 'SMP']);
        if (!isset($_SESSION['codigo_verificado'])) {
            header("Location: " . SERVER_URL . "?view=reset&step=password&error=verificacion_requerida");
            exit();
        }
        $password = mainModel::limpiar_cadena($_POST['password']);
        $confirm_password = mainModel::limpiar_cadena($_POST['confirm_password']);

        if ($password != $confirm_password) {
            header("Location: " . SERVER_URL . "?view=reset&step=password&error=contraseñas_diferentes");
            exit();
        }

        if (mainModel::verificar_datos("[A-Za-zÁÉÍÓÚáéíóúÑñ0-9@$!%*?&._#]{3,100}", $password)) {
            header("Location: " . SERVER_URL . "?view=reset&step=password&error=formato_invalido");
            exit();
        }

        if (isset($_SESSION['user_id_reset'])) {
            $password_hash = mainModel::encryption($password);

            // Verificar si la nueva contraseña es igual a la actual
            $check_current_password = resetModel::get_current_password_model($_SESSION['user_id_reset']);
            if ($check_current_password->rowCount() == 1) {
                $current = $check_current_password->fetch();
                if ($password_hash == $current['us_password_hash']) {
                    header("Location: " . SERVER_URL . "?view=reset&step=password&error=contraseña_igual");
                    exit();
                }
            }

            $datos_password = [
                "password" => $password_hash,
                "id" => $_SESSION['user_id_reset']
            ];

            resetModel::cambiar_password_model($datos_password);

            unset($_SESSION['codigo_verificado']);
            unset($_SESSION['email_enviado']);
            unset($_SESSION['user_id_reset']);

            header("Location: " . SERVER_URL . "?view=login&success=contraseña_cambiada");
            exit();
        } else {
            header("Location: " . SERVER_URL . "?view=reset&step=password&error=sesion_expirada");
            exit();
        }
    }

    /* Método para enviar email */
    private function enviar_email_recuperacion($email, $codigo, $username) {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'quizaes@gmail.com'; // Reemplaza con tu email
            $mail->Password = 'lghlhrsvhwahdfwo'; // Reemplaza con tu contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinatarios
            $mail->setFrom('tuemail@gmail.com', COMPANY);
            $mail->addAddress($email);

            // Contenido
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Código de Recuperación de Contraseña - ' . COMPANY;
            $mail->Body = "
                <h2>Recuperación de Contraseña</h2>
                <p>Hola $username,</p>
                <p>Tu código de verificación para restablecer la contraseña es:</p>
                <h3 style='color: blue; font-size: 24px; text-align: center;'>$codigo</h3>
                <p>Ingresa este código en la página de recuperación para cambiar tu contraseña.</p>
                <p>Este código caducará en 1 hora por seguridad.</p>
                <br>
                <p>Si no solicitaste este cambio, ignora este mensaje.</p>
            ";

            $mail->send();
        } catch (Exception $e) {
            throw new Exception("Error al enviar email: " . $mail->ErrorInfo);
        }
    }
}
?>