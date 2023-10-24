<?php
//product Update API
//by madusha pravinda
//version - 1.0.1
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
$responseObject->status = 'failed';

// chekcing is user logging
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

if (!isset($_POST['category_id']) && !isset($_POST['product_name']) && !isset($_POST['description']) && !isset($_POST['product_id'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// input data
$categoryId = $_POST['category_id'];
$productName = $_POST['product_name'];
$description = $_POST['description'];
$productId = $_POST['product_id'];



//data validation sending object
$dataToValidate = [
     'productName' => [
          (object)['datakey' => 'name', 'value' => $productName],
          // Add more email data objects if needed
     ],
     'description' => [
          (object)['datakey' => 'text_255', 'value' => $description],
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

if ($categoryId == 0) {
     $responseObject->error = "Please select the category";
     response_sender::sendJson($responseObject);
}

//database object
$db = new database_driver();

//data update
$productInsert = "UPDATE `product` SET `product_name`=?,`product_description`=?,`category_id`=? WHERE `product_id`=?";
$db->execute_query($productInsert, 'ssss', array($productName, $description, $categoryId, $productId));
$responseObject->status = 'success';
response_sender::sendJson($responseObject);
