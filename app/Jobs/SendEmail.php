<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Contracts\Mail\Mailer;
use PHPMailer;

class SendEmail implements ShouldQueue{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   
    public function __construct(){
        //
    }

    
    public function handle(PHPMailer $mail){
        
        // Set up SMTP
        $mail->IsSMTP();                // Sets up a SMTP connection
        $mail->SMTPDebug  = 2;          // This will print debugging info
        $mail->SMTPAuth = true;         // Connection with the SMTP does require authorization
        $mail->SMTPSecure = env("MAIL_ENCRYPTION");      // Connect using a TLS connection
        $mail->Host = env('MAIL_HOST');//"smtp.gmail.com";
        $mail->Port = env('MAIL_PORT');//587;
        $mail->Encoding = '7bit';       // SMS uses 7-bit encoding
        $mail->FromName = "Support Team";

        // Authentication
        $mail->Username   = env('MAIL_USERNAME');//$this->username_mail; // Login
        $mail->Password   = env('MAIL_PASSWORD');//$this->password_mail; // Password
        
        // Compose
        $mail->Subject = '$data->subject';     // Subject (which isn't required)
        $mail->Body = '$data->body'.date('Y-m-d H:i:s');        // Body of our message
        
        // Send To
        $mail->AddAddress( 'arvanria@gmail.com' ); // Where to send it

        if(!$mail->Send()) {
            session()->flash('status',  'Error Pesan: ' . $mail->ErrorInfo);
        } else {
            session()->flash('status', 'Pesan telah di kirim');
        }
    }
}
