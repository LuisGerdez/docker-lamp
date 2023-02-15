<?php

namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__.'/../vendor/autoload.php';
require_once "../config/APP.php";

class Mail
{
    //Atributos 
    public PHPMailer $mail;
    public string $asunto = "";
    public string $mensaje = "";
    public string $plantilla = "";


    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;
        $this->mail->isSMTP();
        $this->mail->SMTPKeepAlive = true;
        $this->mail->Host       = Host;
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = Username;
        $this->mail->Password   = Password;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port       = Port;
        $this->mail->setFrom(Username, COMPANY);
    }

    public function enviarCorreo(string $plantilla, string|array $destinatarios, string $asunto = 'Firmadoc', string $attach = null)
    {
        if (gettype($destinatarios) == 'array') {
            foreach ($destinatarios as  $value) {
                try {
                    //Recipients
                    $this->mail->clearAddresses();
                    $this->mail->addAddress($value, 'User');
                    //Content
                    $this->mail->isHTML(true);
                    $this->mail->Subject = COMPANY . $asunto;
                    if(!empty($attach)) $this->mail->addAttachment($attach);
                    $this->mail->Body    = $plantilla;
                    $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    ob_start();
                    $this->mail->send();
                    ob_end_clean();
                } catch (Exception $e) {
                    error_log($e, 0, '../php-error.log');
                    // die();
                }
            }
        } else if (gettype($destinatarios) == 'string') {
            try {
                $this->mail->clearAddresses();
                $this->mail->addAddress($destinatarios, 'User');

                //Content
                $this->mail->isHTML(true);
                $this->mail->Subject = COMPANY . $asunto;
                if(!empty($attach)) $this->mail->addAttachment($attach);
                $this->mail->Body    = $plantilla;
                $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                ob_start();
                $this->mail->send();
                ob_end_clean();
            } catch (Exception $e) {
                error_log($e, 0, '../php-error.log');
                // die();
            }
        } else {
            return 'Parametro no valido';
        }
    }
}
