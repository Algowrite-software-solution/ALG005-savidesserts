<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");
require_once("../model/mail/MailSender.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//check is login user
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
  $responseObject->error = 'Please Sign In';
  response_sender::sendJson($responseObject);
}

$userData = $userCheckSession->getUserId();
$userId = $userData["user_id"];

if (!isset($_POST['Total']) && !isset($_POST['ProductItemPrice']) && !isset($_POST['ExtraToppingsPrice']) && !isset($_POST['globalElementResult']) && !isset($_POST['orderId'])) {
  $responseObject->error = 'Access denied';
  response_sender::sendJson($responseObject);
}

//request parameters
$totalCost = $_POST['Total'];
$productItemPrice = $_POST['ProductItemPrice'];
$extraToppingsPrice = $_POST['ExtraToppingsPrice'];
$orderId = $_POST['orderId'];
$shippingPrice = $_POST['shippingPrice'];
$jsonString = $_POST['globalElementResult'];

//decode json result
$elementResult = json_decode($jsonString, true);

//global DB object
$db = new database_driver();


//php date object
date_default_timezone_set('Asia/Colombo');
$currentDate = date('Y-m-d');

//add data for invoice
$insertQueryInvoice = "INSERT INTO `invoice` (`order_date`,`pay_amout`,`shipping_price`,`order_id`,`user_user_id`,`invoice_status_invoice_status_id`) VALUES (?,?,?,?,?,?)";
$db->execute_query($insertQueryInvoice, 'ssssss', array($currentDate, $totalCost, $shippingPrice, $orderId, $userId, '1'));



// get all details
foreach ($elementResult as $requestArray) {

  $card_id = $requestArray['card_id'];
  $price = $requestArray['price'];
  $category_type = $requestArray['category_type'];
  $extra_fruit = $requestArray['extra_fruit'];
  $extra_id = $requestArray['extra_id'];
  $extra_price = $requestArray['extra_price'];
  $product_id = $requestArray['product_id'];
  $product_item_id = $requestArray['product_item_id'];
  $product_name = $requestArray['product_name'];
  $qty = $requestArray['qty'];
  $weight = $requestArray['weight'];
  $weight_id = $requestArray['weight_id'];

  // invoice item add
  $insertInvoiceItem = "INSERT INTO `invoice_item` (`qty`,`total_product_items_price`,`order_id`,`extra_item_price`,`product_name`,`weight`,`extra_item_name`) VALUES (?,?,?,?,?,?,?)";
  $db->execute_query($insertInvoiceItem, 'sssssss', array($qty, $price, $orderId, $extra_price, $product_name, $weight, $extra_fruit));

  //product Item Search
  $searchQuery = "SELECT * FROM `product_item` WHERE `id`=?";
  $result = $db->execute_query($searchQuery, 's', array($product_item_id));

  //get and new qty calculation
  $relatedProductItem = $result['result']->fetch_assoc();
  $oldQty = $relatedProductItem['qty'];
  $intOldQty = intval($oldQty);
  $buyQty = intval($qty);

  //new qty
  $newQty = $intOldQty - $buyQty;

  //updateProductItem
  $updateProductItem = "UPDATE `product_item` SET `qty`=? WHERE `id`=?";
  $db->execute_query($updateProductItem, 'ii', array($newQty, $product_item_id));


  //delete product user cart
  $deleteProductItemCart = "DELETE FROM `card` WHERE `id`=? AND `user_user_id`=?";
  $db->execute_query($deleteProductItemCart, 'ii', array($card_id, $userId));
}

//product Item Search
$searchQuery = "SELECT * FROM `user` WHERE `user_id`=?";
$result = $db->execute_query($searchQuery, 's', array($userId));

//get email
$userResult = $result['result']->fetch_assoc();
$email = $userResult['email'];



//email template
$mailer = new MailSender($email);
$body = <<< HTML
<div style="width: max-content; font-family: Arial, Helvetica, sans-serif; margin: 20px; background-color: #0a1411; border-radius: 30px; padding: 20px; color: #f6f6f6;">
  <h1 style="text-align: center;">Sawee Dessert</h1>
  <hr />
  <div style="display: flex; width: 100%">
    <h4 style="font-weight: bold; border-radius: 20px 0 0 20px; background-color: #b68b40; padding: 10px; color: #122620; margin: 0;">Order Id</h4>
    <p style="border-radius: 0 20px 20px 0; background-color: #d6ad60; color: #0a1411; margin-top: 10px; display: flex; align-items: center; justify-items: center; padding: 0 30px; flex-grow: 1;">{$orderId}</p>
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
HTML;
foreach ($elementResult as $item) {
  $body .= <<< HTML
            <tr>
              <td style="padding: 10px; background-color: #f4ebd0; color: #0a1411;">{$item['product_name']}</td>
              <td style="padding: 10px; background-color: #f4ebd0; color: #0a1411;">{$item['weight']}</td>
              <td style="padding: 10px; background-color: #f4ebd0; color: #0a1411;">LKR. {$item['price']}</td>
              <td style="padding: 10px; background-color: #f4ebd0; color: #0a1411;">{$item['qty']}</td>
              <td style="padding: 10px; background-color: #f4ebd0; color: #0a1411;">{$item['extra_fruit']} : LKR. {$item['extra_price']}</td>
            </tr>
HTML;
}
$body .= <<< HTML
          </tbody>
        </table>
    </div>
    <div>
        <table style="border: black 1px solid; border-collapse: collapse;">
            <tr>
                <td style="background-color: #f4ebd0; color: #0a1411; padding: 10px;">Sub total</td>
                <td style="background-color: #f4ebd0; color: #0a1411; padding: 10px;">LKR. {$productItemPrice}</td>
            </tr>
            <tr>
                <td style="background-color: #f4ebd0; color: #0a1411; padding: 10px;">Topping price</td>
                <td style="background-color: #f4ebd0; color: #0a1411; padding: 10px;">LKR. {$extraToppingsPrice}</td>
            </tr>
            <tr>
                <td style="background-color: #f4ebd0; color: #0a1411; padding: 10px;">Shipping Cost</td>
                <td style="background-color: #f4ebd0; color: #0a1411; padding: 10px;">LKR. {$shippingPrice}</td>
            </tr>
            <tr>
                <td style="background-color: #b68b40; color: #f6f6f6; padding: 10px;">Total</td>
                <td style="background-color: #b68b40; color: #f6f6f6; padding: 10px;">LKR. {$totalCost}</td>
            </tr>
        </table>
    </div>
  </div>
  <hr>
  <div style="display: flex; justify-content: center;">
    <div style="padding: 10px; background-color: #d6ad60; margin: 5px 0; border-radius: 30px;"><a style="color: #0a1411; text-decoration: none;" href="https://saweedessert.com/reviewSection.php">Give Us a Review</a></div>
  </div>
</div>
HTML;
$mailer->mailInitiate("sawee dessert", "#invoice", $body);

$error = $mailer->sendMail();

if ($error === 'Verification code sending failed') {
  $responseObject->error = $error;
  response_sender::sendJson($responseObject);
} else {

  $responseObject->status = 'success';
  response_sender::sendJson($responseObject);
}
