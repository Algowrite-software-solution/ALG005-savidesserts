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
$responseObject->status = 'false';

// chekcing is user logging
$userCheckSession = new SessionManager();
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
$imageId = $_POST['image_id'];



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


if (is_array($_FILES['product_image']['error'])) {
     $imageUrls = [];

     // Loop through each uploaded file
     foreach ($_FILES['product_image']['error'] as $key => $error) {
          if ($error === 0) {
               // files manage 
               $allowImageExtension = ['png', 'jpg', 'jpeg'];
               $fileExtension = strtolower(pathinfo($_FILES['product_image']['name'][$key], PATHINFO_EXTENSION));

               // file extension checks
               if (!in_array($fileExtension, $allowImageExtension)) {
                    $responseObject->error = 'Only png,jpg and jpeg file formats are allowed';
                    response_sender::sendJson($responseObject);
               }

               //file save path and file name create
               $savePath = "../../resources/images/singleProductImg/";
               $newImageName = "productId=" . $productId . "&&" . "weightId=" . $weightId . "&&" . "image=" . $imageId . "." . $fileExtension;

               if (move_uploaded_file($_FILES['product_image']['tmp_name'], $savePath . $newImageName)) {
                    $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $newImgUrl = str_replace("api/productItemAdding.php", "", $currentURL) . "../../resources/images/singleProductImg/" . $newImageName;
                    // Add the image URL to the array
                    $imageUrls[] = $newImgUrl;
               } else {
                    $responseObject->error = "Image upload failed";
                    response_sender::sendJson($responseObject);
               }
          } else {
               $responseObject->error = "upload one or more images";
               response_sender::sendJson($responseObject);
          }
     }

     //insert product Item
     $productItemInsert = "INSERT INTO `product_item` (`qty`,`price`,`product_status_id`,`product_product_id`,`weight_id`) VALUES (?,?,?,?,?)";
     $db->execute_query($productItemInsert, 'sssss', array($qty, $price, '1', $productId, $weightId));
     $responseObject->status = "product item adding success";
     $responseObject->result = $newImgUrl;
     response_sender::sendJson($responseObject);
} else {
     $responseObject->error = "no images upload";
     response_sender::sendJson($responseObject);
}
