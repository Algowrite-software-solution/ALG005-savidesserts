<?php
require_once("MailSender.php");

$mailer = new MailSender("wickramarathnapravinda2001@gmail.com");
$body = <<<'HTML'
<div style="width: max-content; font-family: Arial, Helvetica, sans-serif; margin: 20px; background-color: #0a1411; border-radius: 30px; padding: 20px; color: #f6f6f6;">
  <h1 style="text-align: center;">Sawee Dessert</h1>
  <hr />
  <div style="display: flex; width: 100%">
    <h4 style="font-weight: bold; border-radius: 20px 0 0 20px; background-color: #b68b40; padding: 10px; color: #122620; margin: 0;">Order Id</h4>
    <p style="border-radius: 0 20px 20px 0; background-color: #d6ad60; color: #0a1411; margin: 0; display: flex; align-items: center; padding: 0 30px; flex-grow: 1;">123324</p>
  </div>
  <hr>
  <div>
    <div>
        <table style="margin: 30px 0; color: #f6f6f6; border-style: solid; border-collapse: collapse; border-radius: 20px; border: #122620 3px solid;" border="1">
          <thead>
            <tr>
              <th style="padding: 10px; background-color: #b68b40; color: #f6f6f6;">Product Name</th>
              <th style="padding: 10px; background-color: #b68b40; color: #f6f6f6;">Weight</th>
              <th style="padding: 10px; background-color: #b68b40; color: #f6f6f6;">Price</th>
              <th style="padding: 10px; background-color: #b68b40; color: #f6f6f6;">Qty</th>
              <th style="padding: 10px; background-color: #b68b40; color: #f6f6f6;">Extra & Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="padding: 10px; background-color: #f4ebd0; color: #0a1411;">Watapallm</td>
              <td style="padding: 10px; background-color: #f4ebd0; color: #0a1411;">2kg</td>
              <td style="padding: 10px; background-color: #f4ebd0; color: #0a1411;">2300 LKR</td>
              <td style="padding: 10px; background-color: #f4ebd0; color: #0a1411;">2</td>
              <td style="padding: 10px; background-color: #f4ebd0; color: #0a1411;">Kaju : 200 LKR</td>
            </tr>
            <!-- Repeat the <tr> for other items as needed -->
          </tbody>
        </table>
    </div>
    <div>
        <table style="border: black 1px solid; border-collapse: collapse;">
            <tr>
                <td style="background-color: #b68b40; color: #f6f6f6; padding: 10px;">Total</td>
                <td style="background-color: #b68b40; color: #f6f6f6; padding: 10px;">3000LKR</td>
            </tr>
            <tr>
                <td style="background-color: #f4ebd0; color: #0a1411; padding: 10px;">Shipping Cost</td>
                <td style="background-color: #f4ebd0; color: #0a1411; padding: 10px;">300LKR</td>
            </tr>
        </table>
    </div>
  </div>
  <hr>
  <div style="display: flex; justify-content: center;">
    <div style="padding: 10px; background-color: #d6ad60; margin: 5px 0; border-radius: 30px;"><a style="color: #0a1411; text-decoration: none;" href="www.youtube.com">Give Us a Review</a></div>
  </div>
</div>
HTML;
$mailer->mailInitiate("mail sender test", "this is title", $body);

$error = $mailer->sendMail();
if ($error) {
    echo $error;
} else {
    echo "no";
}
