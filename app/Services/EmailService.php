<?php

namespace App\Services;

use App\Models\SmtpEmail;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\View;

require_once base_path('vendor/phpmailer/phpmailer/src/Exception.php');
require_once base_path('vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once base_path('vendor/phpmailer/phpmailer/src/SMTP.php');

class EmailService
{
    public function sendEmail($subject, $view, $data, $recipient, $attachment = null, $new_filename = null)
    {
        try {
            $email_settings = SmtpEmail::where('status', 1)->first();
            $body = View::make($view, $data)->render();

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = $email_settings->smtp_server;
            $mail->SMTPAuth = true;
            $mail->Username = $email_settings->emails;
            $mail->Password = $email_settings->smtp_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $email_settings->port;
            $sender = $email_settings->emails;

            $mail->setFrom($sender, 'LogonBroadband');
            $mail->addAddress($recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body);

            if ($attachment) {
                if ($new_filename) {
                    $mail->addAttachment($attachment, $new_filename);
                } else {
                    $mail->addAttachment($attachment);
                }
            }

            $mail->send();

            return true;
        } catch (Exception $e) {
            dd($e);
            return false;
        }
    }
}
