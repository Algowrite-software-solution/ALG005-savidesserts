<?php
//product Item Update API
//by madusha pravinda
//version - 1.0.0
//26-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/data_validator.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'false';

// chekcing is user logging
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

if (!isset($_POST['id']) && !isset($_POST['qty']) && !isset($_POST['price']) && !isset($_POST['product_status_id']) && !isset($_POST['product_product_id']) && !isset($_POST['weight_id'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// input data
$productItemId = $_POST['id'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$productItemStatusId = $_POST['product_status_id'];
$productId = $_POST['product_product_id'];
$weightId = $_POST['weight_id'];



//data validation sending object
$dataToValidate = [
     'qty' => [
          (object)['datakey' => 'int_or_null', 'value' => $qty],
          // Add more email data objects if needed
     ],
     'weightId' => [
          (object)['datakey' => 'id_int', 'value' => $weightId],
          // Add more password data objects if needed
     ],
     'productId' => [
          (object)['datakey' => 'id_int', 'value' => $productId],
          // Add more password data objects if needed
     ],
     'price' => [
          (object)['datakey' => 'price', 'value' => $price],
          // Add more password data objects if needed
     ],

];

// Create an instance of the data_validator class
$validator = new data_validator($dataToValidate);

// Perform validation
$errors = $validator->validate();


// Check for validation errors
if (!empty((array)$errors)) {
     $responseObject->error = $errors;
     response_sender::sendJson($responseObject);
}

if ($productId == 0) {
     $responseObject->error = "Please select the product";
     response_sender::sendJson($responseObject);
}
if ($weightId == 0) {
     $responseObject->error = "Please select the weight";
     response_sender::sendJson($responseObject);
}

//database object
$db = new database_driver();

//data update
$productItemUpdate = "UPDATE `product_item` SET `qty`=?,`price`=?,`product_status_id`=?,`product_product_id`=?,`weight_id`=? WHERE `id`=?";
$db->execute_query($productItemUpdate, 'ssssss', array($qty, $price, $productItemStatusId, $productId, $weightId, $productItemId));
$responseObject->status = 'Product Item Update Success';
response_sender::sendJson($responseObject);
