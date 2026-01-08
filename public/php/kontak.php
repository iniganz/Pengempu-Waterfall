<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class KontakController extends Controller
{
    public function kirim(Request $request)
    {
        $name = htmlspecialchars($request->input('name'));
        $email = htmlspecialchars($request->input('email'));
        $subject = htmlspecialchars($request->input('subject'));
        $message = htmlspecialchars($request->input('message'));

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gandhigunadi07@gmail.com';
            $mail->Password = 'legt gdrl vbms hwxs';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ];

            $mail->setFrom('yourgmail@gmail.com', 'Website Contact Form');
            $mail->addAddress('yourgmail@gmail.com');
            $mail->addReplyTo($email, $name);

            $mail->isHTML(false);
            $mail->Subject = "Pesan baru dari $name";
            $mail->Body = "Nama: $name\nEmail: $email\nPesan:\n$message";

            $mail->send();

            // ✅ Kembalikan response JSON untuk digunakan di frontend
            return response()->json([
                'status' => 'success',
                'message' => 'Pesan berhasil dikirim!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Pesan gagal dikirim. Error: {$mail->ErrorInfo}"
            ]);
        }
    }
}
