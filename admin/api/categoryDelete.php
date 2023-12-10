<?php
//category delete API
//by madusha pravinda
//version - 1.0.0
//29-11-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/RequestHandler.php");
// headers
header("Content-Type: application/json; charset=UTF-8");
//response
$responseObject = new stdClass();
$responseObject->status = 'failed';

// validate request
if (!RequestHandler::isGetMethod()) {
       $responseObject->error = "Invalid Request";
       response_sender::sendJson($responseObject);
}

// checking is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
       $responseObject->error = 'Please Login';
       response_sender::sendJson($responseObject);
}

//request parameters
$imagePath = $_GET['category_image_path'];
$categoryId = $_GET['category_id'];


try {
       $db = new database_driver();
       $deleteQuery = "DELETE FROM `category` WHERE `id`=?";
       $db->execute_query($deleteQuery, 'i', array($categoryId));

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
} catch (mysqli_sql_exception $e) {
       $responseObject->error = "Cannot delete category because it is still being used by a product";
       response_sender::sendJson($responseObject);
}
