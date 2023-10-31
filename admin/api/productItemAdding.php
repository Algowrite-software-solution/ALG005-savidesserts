<?php
//product Item Adding API
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
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

if (!isset($_POST['qty']) && !isset($_POST['price']) && !isset($_POST['product_id']) && !isset($_POST['weight_id']) && !isset($_FILES['product_image'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

//input data
$qty = $_POST['qty'];
$price = $_POST['price'];
$weightId = $_POST['weight_id'];
$productId = $_POST['product_id'];



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


//search already product items
$productItemSearch = "SELECT * FROM `product_item` WHERE `product_product_id`=? AND `weight_id`=?";
$productResult = $db->execute_query($productItemSearch, 'ss', array($productId, $weightId));

if ($productResult['result']->num_rows > 0) {
     $responseObject->error = 'oops ! this product already added';
     response_sender::sendJson($responseObject);
}


if (isset($_POST['product_image'])) {
     $imageArray = json_decode($_POST['product_image']);
     $imageUrls = [];

     // Loop through each uploaded file
     $countIndex = 0;
     foreach ($imageArray as  $value) {
          if ($value) {
               // files manage 
               // Remove the "data:image/jpeg;base64," part to get the base64 data
               $base64Data = substr($value, strpos($value, ',') + 1);

               $binaryData = base64_decode($base64Data);
               $fileExtension = ".jpg";

               // //file save path and file name create
               $savePath = "../../resources/images/singleProductImg/";
               $newImageName = "productId=" . $productId . "&&" . "weightId=" . $weightId . "&&" . "image=" . $countIndex  . $fileExtension;
               $countIndex++;

               // Save the image to a file
               file_put_contents($savePath . $newImageName, $binaryData);
          } else {
               $responseObject->error = "upload one or more images";
               response_sender::sendJson($responseObject);
          }
     }

     //insert product Item
     $productItemInsert = "INSERT INTO `product_item` (`qty`,`price`,`product_status_id`,`product_product_id`,`weight_id`) VALUES (?,?,?,?,?)";
     $db->execute_query($productItemInsert, 'sssss', array($qty, $price, '1', $productId, $weightId));
     $responseObject->status = "success";
     response_sender::sendJson($responseObject);
} else {
     $responseObject->error = "no images upload";
     response_sender::sendJson($responseObject);
}
