<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/PHPMailer/src/Exception.php';

class PHP_Email_Form
{
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $smtp;
    public $ajax = false;

    private $messages = array();

    function add_message($content, $label = '', $min_length = 4)
    {
        if (!empty($content) && strlen($content) >= $min_length) {
            $this->messages[] = "$label: $content";
        }
    }

    function send()
    {
        $email_content = implode("\n", $this->messages);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = $this->smtp['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->smtp['username'];
            $mail->Password   = $this->smtp['password'];
            $mail->SMTPSecure = 'tls';
            $mail->Port       = $this->smtp['port'];

            $mail->setFrom($this->from_email, $this->from_name);
            $mail->addAddress($this->to);
            $mail->Subject = $this->subject;
            $mail->Body    = $email_content;

            $mail->send();
            return $this->ajax ? 'OK' : 'Pesan berhasil dikirim via SMTP.';
        } catch (Exception $e) {
            return 'ERROR: ' . $mail->ErrorInfo;
        }
    }
}
