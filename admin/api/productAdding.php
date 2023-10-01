<?php
//product Adding API
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
$responseObject->status = 'failed';

// chekcing is user logging
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

if (!isset($_POST['category_id']) && !isset($_POST['product_name']) && !isset($_POST['description'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// input data
$categoryId = $_POST['category_id'];
$productName = $_POST['product_name'];
$description = $_POST['description'];



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

// data search
$searchProduct = "SELECT * FROM `product` WHERE `product_name`=? AND `category_id`=?";
$resultSet = $db->execute_query($searchProduct, 'ss', array($productName, $categoryId));

// check already have
if ($resultSet['result']->num_rows > 0) {
     $responseObject->error = 'This product already have';
     response_sender::sendJson($responseObject);
}

//send 6 number of verification code our email and update our db();
//generate 6 number of id
$six_digit_random_number_productId = random_int(100000, 999999);

//php date object
$currentDate = date('Y-m-d');
//data insert
$productInsert = "INSERT INTO `product` (`product_id`,`product_name`,`product_description`,`category_id`,`add_date`) VALUES (?,?,?,?,?) ";
$db->execute_query($productInsert, 'sssss', array($six_digit_random_number_productId, $productName, $description, $categoryId, $currentDate));
$responseObject->status = 'success';
response_sender::sendJson($responseObject);
