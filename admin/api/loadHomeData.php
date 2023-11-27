<?php
// load total product item count
// load all User count
// load Total Selling count
// load best buyers **********Still not developed***************

//dev by madusha
//dev date - 2023/11/28

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/RequestHandler.php");

// headers
header("Content-Type: multipart/form-data; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'failed';

//request handler
if (!RequestHandler::isGetMethod()) {
       $responseObject->error = 'Access denied';
       response_sender::sendJson($responseObject);
}

// checking is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
       $responseObject->error = 'Please LogIn';
       response_sender::sendJson($responseObject);
}

// Create array 
$response = [];

//response object
$resObject = new stdClass;

//database object
$db = new database_driver();

//user count
$searchUser = "SELECT * FROM `user`";
$userCount = $db->query($searchUser);

$userResult = $userCount->num_rows;
$resObject->user_count = $userResult;


//all product item count
$searchProductItem = "SELECT * FROM `product_item`";
$productItemCount = $db->query($searchProductItem);

$productItemResult = $productItemCount->num_rows;
$resObject->product_item_count = $productItemResult;


//total selling
$searchInvoiceItem = "SELECT qty FROM `invoice_item`";
$searchInvoiceItemCount = $db->query($searchInvoiceItem);


$qtyCount = 0; // Initialize the total quantity variable

for ($i = 0; $i < $searchInvoiceItemCount->num_rows; $i++) {
       $row = $searchInvoiceItemCount->fetch_assoc();
       $qtyCount += $row['qty']; // Accumulate the quantity for each row
}
$resObject->total_selling = $qtyCount;


//best buyer count



array_push($response, $resObject);
$responseObject->status = 'success';
$responseObject->result = $response;
response_sender::sendJson($responseObject);
