<?php
//product Item Load API
//by madusha pravinda
//version - 1.0.2
//02-10-2023

//include models
require_once("../../backend/model/imageSearchEngine.php");
require_once("../../backend/model/response_sender.php");

// headers
header("Content-Type: application/json; charset=UTF-8");
//response
$responseObject = new stdClass();
$responseObject->status = 'failed';


$imagePath = $_GET['category_image_path'];

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
