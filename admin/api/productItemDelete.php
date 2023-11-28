<?php
//product Item Update API
//by madusha pravinda
//version - 1.0.0
//26-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/fileSearch.php");

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

if (!isset($_GET['id'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// input data
$productItemId = $_GET['id'];

//database object
$db = new database_driver();

//data delete
$produtItemData = $db->execute_query("SELECT * FROM `product_item` WHERE `id` = ? ", "i", [$productItemId]);
$productsDetails = $produtItemData["result"]->fetch_all(1)[0];
$imagesNameQuery = "productId=" . $productsDetails["product_product_id"] . "&&weightId=" . $productsDetails["weight_id"] . "&&image=";

$fileScanner = new FileSearch("../../resources/images/singleProductImg/", $imagesNameQuery, ["jpg"]);
$images = $fileScanner->getFilesWithSubstring($imagesNameQuery);

if (!empty($images)) {
     foreach ($images as $value) {
          unlink("../../resources/images/singleProductImg/" . $value);
     }
}

$productItemDelete = "DELETE FROM `product_item`  WHERE `id`=?";
$db->execute_query($productItemDelete, 's', array($productItemId));
$responseObject->status = 'success';
response_sender::sendJson($responseObject);
