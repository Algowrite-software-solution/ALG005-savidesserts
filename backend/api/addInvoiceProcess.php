<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");

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
$globalElementResult = $_POST['globalElementResult'];
$orderId = $_POST['orderId'];


//global DB object
$db = new database_driver();


//php date object
$currentDate = date('Y-m-d');

//order Id generate
$orderId = '#' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);


//get all details
foreach ($globalElementResult as $key => $requestArray) {
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
     $insertInvoiceItem = "INSERT INTO `invoice_item` (`product_item_id`,`extra_id`,`weight_id`,`qty`,`total_product_items_price`,`order_id`,`extra_item_price`) VALUES (?,?,?,?,?,?,?)";
     $db->execute_query($insertInvoiceItem, 'sssssss', array($product_item_id, $extra_id, $weight_id, $qty, $price, $orderId, $extra_price));
}


$insertQueryInvoice = "INSERT INTO `invoice` (`order_date`,`pay_amout`,`shipping_price`,`order_id`,`user_user_id`,`invoice_status_invoice_status_id`) VALUES (?,?,?,?,?,?)";
$db->execute_query($insertQueryInvoice, 'ssssss', array($currentDate, $totalCost, '200', $orderId, $userId, '1'));
$responseObject->status = 'success';
response_sender::sendJson($responseObject);
