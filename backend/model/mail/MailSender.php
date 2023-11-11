<?php
# developer : janith nirmal
# algowrite software solution
## date : 30-08-2023 
## version : 1.0.0

require_once "SMTP.php";
require_once "PHPMailer.php";
require_once "Exception.php";

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

final class MailSender
{

    private $mail;
    private $senderMail;
    private $toAddress;
    private $password;

    public function __construct($toAddress)
    {
        $this->senderMail = 'saweedessert@gmail.com';
        $this->password = 'erditwxffhzjeydu';
        $this->toAddress = $toAddress;
    }

    public function mailInitiate($subject, $title, $bodyContent)
    {
        try {
            // email code
            $this->mail = new PHPMailer(true);
            $this->mail->IsSMTP();
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPAuth = true;
            $this->mail->SMTPAuth = true;
            $this->mail->Username = $this->senderMail;
            $this->mail->Password = $this->password;
            $this->mail->SMTPSecure = 'ssl';
            $this->mail->Port = 587;
            $this->mail->setFrom($this->senderMail, $title);
            $this->mail->addReplyTo($this->senderMail, $title);
            $this->mail->addAddress($this->toAddress);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;

            $this->mail->Body    = $bodyContent;
        } catch (Exception $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
    }

    public function sendMail()
    {
        try {
            if (!$this->mail->send()) {
                return $this->mail;
            } else {
                return "success";
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}


$mailer = new MailSender("rmjanithnirmal@gmail.com");

$html =  <<<HTML
<div style="padding: 20px; background-color: orange;">
    <h1>Hello, World!</h1>
    <p>This is a sample HTML page.</p>
</div>
HTML;

$mailer->mailInitiate("testing mail", "this is a temp mail", $html);
echo $mailer->sendMail();
