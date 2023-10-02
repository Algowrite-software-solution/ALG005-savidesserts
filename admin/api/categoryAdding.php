<?php

//category Adding API
//by madusha pravinda
//version - 1.0.2
//2-10-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'false';

// chekcing is user logging
// $userCheckSession = new SessionManager();
// if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
//      $responseObject->error = 'Please LogIn';
//      response_sender::sendJson($responseObject);
// }

if (!isset($_POST['category_type']) && !isset($_FILES['category_image']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// input data
$category_type = $_POST['category_type'];


//database object
$db = new database_driver();
$searchQuery = "SELECT * FROM `category` WHERE `category_type`=?";
$resultSet = $db->execute_query($searchQuery, 's', array($category_type));

if ($resultSet['result']->num_rows > 0) {
     $responseObject->error = 'This category already have';
     response_sender::sendJson($responseObject);
}


if ($_FILES['category_image']['error'] === 0) {
     $allowImageExtension = ['png', 'jpg', 'jpeg'];
     $fileExtension = strtolower(pathinfo($_FILES['category_image']['name'], PATHINFO_EXTENSION));


     if (in_array($fileExtension, $allowImageExtension)) {
          // Generate a unique image ID (you can use any method you prefer)
          $imageId = random_int(100000, 999999);

          // Define the destination directory
          $savePath = "../../resources/images/categoryImages/";
          $newImageName = "id=" . $imageId . "&&" . "categoryName=" . $category_type .  "." . $fileExtension;


          if (move_uploaded_file($_FILES['category_image']['tmp_name'], $savePath . $newImageName)) {
               // data insert
               $insertCategory = "INSERT INTO `category` (`category_type`) VALUES (?)";
               $db->execute_query($insertCategory, 's', array($category_type));
               $responseObject->status = 'Added Success';
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
