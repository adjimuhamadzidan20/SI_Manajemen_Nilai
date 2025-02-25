<?php

namespace App\Controllers;
use App\Models\LupapasswordModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Lupapassword extends BaseController
{
    public function index()
    {
        return view('lupa_password_view');
    }

    public function ganti_password() {
        $resetPass = new LupapasswordModel();

        $email = $this->request->getPost('email');
        $passwordBaru = $this->request->getPost('password_baru');
        $resetPass->gantiPass($email, md5($passwordBaru));
        
        $emailPengirim = 'simanajemennilaisystem@email.com';
        $namaPengirim = 'SI Manajemen Nilai'; 
        $emailPenerima = $email; 
        $subjek = 'Forgot password user or administration';
        
        $pesan = 'Selamat password anda telah terganti serta terpulihkan, silahkan anda dapat melakukan login kembali, 
        pastikan username anda sesuai dan mohon untuk mencatat password yang dipakai, terima kasih..';
        
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;     
            $mail->isSMTP(); 
            $mail->Host       = 'smtp.gmail.com';                                                                    
            $mail->SMTPAuth   = true;                      
            $mail->Username   = $emailPengirim;
            $mail->Password   = 'uqvn fwcq ktmq hcsm';                                                
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
            $mail->Port       = 465; 

            //Content
            $mail->setFrom($emailPengirim, $namaPengirim);
            $mail->addAddress($emailPenerima);
            $mail->isHTML(true);                                 
            $mail->Subject = $subjek;
            $mail->Body    = $pesan;

            $mail->send();           

            $info = 'Password anda telah terubah!';
            session()->setFlashData('alert', $info);
            return redirect()->to('/forgot_password');
        } 
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
