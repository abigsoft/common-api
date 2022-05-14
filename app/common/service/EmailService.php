<?php

namespace app\common\service;

use app\common\model\ConfigModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use think\Exception;
use think\facade\Log;

class EmailService extends BaseService
{
    public static function send($email,$title,$info){

        buildConfig();

        if(!config('sys.smtp_status')){
            Log::write('未开启');
            return false;
        }
        if(!$email){
            Log::write('邮箱号错误');
            return false;
        }
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->CharSet='UTF-8';
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Host       = config('sys.smtp_host');                     //Set the SMTP server to send through
            $mail->Username   = config('sys.smtp_username');                     //SMTP username
            $mail->Password   = config('sys.smtp_password');                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = config('sys.smtp_port');                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom(config('sys.smtp_address'), config('sys.site_title'));
            $mail->addAddress($email, '用户');     //Add a recipient
            $mail->addReplyTo(config('sys.smtp_address'), '回复');

            $mail->Subject = $title;
            $mail->Body    = $info;

            $mail->send();
            return true;
        } catch (Exception $e) {
            Log::write($mail->ErrorInfo);
            return $mail->ErrorInfo;
        }


    }
}