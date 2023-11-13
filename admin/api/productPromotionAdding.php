<?php
// /include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/RequestHandler.php");
require_once("../../backend/model/data_validator.php");
// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

//request checker
if (!RequestHandler::isPostMethod()) {
     $responseObject->error = 'wrong request method';
     response_sender::sendJson($responseObject);
}

//parameters
if (!isset($_POST['end_date_time'], $_POST['product_id'], $_POST['weight_id'])) {
     $responseObject->error = 'Invalid Parameters';
     response_sender::sendJson($responseObject);
}

$endDateTime = $_POST['end_date_time'];
$productId = $_POST['product_id'];
$weightId = $_POST['weight_id'];

//data validation
$validateReadyObject = (object) [
     "int_or_null" => [
          (object) ["datakey" => "product_id", "value" => $productId],
          (object) ["datakey" => "weight_id", "value" => $weightId],
     ],
];

$validator = new data_validator($validateReadyObject);
$errors = $validator->validate();
foreach ($errors as $key => $value) {
     if ($value) {
          $responseObject->error = "Invalid Input for : " . $key;
          response_sender::sendJson($responseObject);
     }
}

$db = new database_driver();

//search already active promotion above the product
$statusId = '1';
$searchPromotion = "SELECT * FROM `promotion` WHERE `product_product_id`=? AND `weight_id`=? AND `promotion_status_promotion_status_id`=?";
$searchResult = $db->execute_query($searchPromotion, 'iis', array($productId, $weightId, $statusId));

if ($searchResult['result']->num_rows > 0) {
     $responseObject->error = 'promotions are already assigned to this product';
     response_sender::sendJson($responseObject);
}

if ($_FILES['promotion_image']['error'] === 0) {
     $allowImageExtension = ['png', 'jpg', 'jpeg'];
     $fileExtension = strtolower(pathinfo($_FILES['promotion_image']['name'], PATHINFO_EXTENSION));


     if (in_array($fileExtension, $allowImageExtension)) {

          $promotionId = random_int(100000, 999999);
          // Define the destination directory
          $savePath = "../../resources/images/promotionImages/";
          $newImageName = $promotionId .  "." . $fileExtension;


          if (move_uploaded_file($_FILES['promotion_image']['tmp_name'], $savePath . $newImageName)) {

               // data insert
               date_default_timezone_set('Asia/Colombo');
               $currentDate = date('Y-m-d H:i:s');


               $insertPromotion = "INSERT INTO `promotion` (`promotion_id`,`start_date_time`,`end_date_time`,`promotion_status_promotion_status_id`,`product_product_id`,`weight_id`) VALUES (?,?,?,?,?,?)";
               $db->execute_query($insertPromotion, 'issiii', array($promotionId, $currentDate, $endDateTime, $statusId, $productId, $weightId));
               $responseObject->status = 'success';
               response_sender::sendJson($responseObject);

          } else {
               $responseObject->error = 'Failed to save the image';
               response_sender::sendJson($responseObject);
          }
     } else {
          $responseObject->error = 'Invalid file type';
          response_sender::sendJson($responseObject);
     }
} else {
     $responseObject->error = 'No image upload';
     response_sender::sendJson($responseObject);
}
