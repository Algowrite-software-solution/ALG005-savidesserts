<?php
require_once("MailSender.php");

$mailer = new MailSender("rmjanithnirmal@gmail.com");
$body = <<<'HTML'
<div style="border-radius: 20px; background-color: #122620;">
  <h2 style="text-align: center; color: #b68b40; padding: 20px 0 0 0;">SAWEE DESSERT</h2>
  <hr>
  <div style="background-color: #b68b40; color: black; border-radius: 20px; ">
    <h3 style="text-align: center; background-color: #122620;color: #b68b40; padding: 10px;">Verification Code</h3>
    <div style="text-align: center; padding: 10px; font-weight: bold;">153452</div>
  </div>
</div>
HTML;
$mailer->mailInitiate("mail sender test", "this is title", $body);

$error = $mailer->sendMail();
if ($error) {
  echo var_dump($error);
} else {
  echo "no";
}
