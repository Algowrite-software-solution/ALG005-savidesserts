<?php
//promotion image delete API
//by madusha pravinda
//version - 1.0.0
//12-11-2023

//include models
require_once("../../backend/model/imageSearchEngine.php");
require_once("../../backend/model/response_sender.php");

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


$imagePath = $_POST['promotion_image_path'];

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
