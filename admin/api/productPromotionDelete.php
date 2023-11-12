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
if (!isset($_POST['promotion_id'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

$promotionId = $_POST['promotion_id'];

//data validation
$validateReadyObject = (object) [
     "int_or_null" => [
          (object) ["datakey" => "promotion_id", "value" => $promotionId]
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
$promotionDelete = "DELETE FROM `promotion` WHERE `promotion_id`=?";
$db->execute_query($promotionDelete, 'i', array($promotionId));

$imagePath = "../../resources/images/promotionImages/$promotionId.jpg";

if (file_exists($imagePath)) {
     if (unlink($imagePath)) {
          $responseObject->status = 'success';
          response_sender::sendJson($responseObject);
     } else {
          $responseObject->error = 'Failed to delete the image.';
          response_sender::sendJson($responseObject);
     }
} else {
     $responseObject->error = 'Image does not exist.';
     response_sender::sendJson($responseObject);
}
