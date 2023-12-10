<?php
//product delete API
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
$productId = $_GET['product_id'];
$db = new database_driver();

//delete all products in product cart
$searchProductCart = "SELECT * FROM `card` WHERE `product_product_id`=?";
$result = $db->execute_query($searchProductCart, 's', array($productId));

$resultSet = $result['result'];

while ($row = $resultSet->fetch_assoc()) {
       $deleteCartFromProduct = "DELETE FROM `card` WHERE `id`=?";
       $db->execute_query($deleteCartFromProduct, 'i', array($row['id']));
}
//delete all products in product watchlist
$searchProductWatchlist = "SELECT * FROM `watchlist` WHERE `product_product_id`=?";
$result = $db->execute_query($searchProductWatchlist, 's', array($productId));

$resultSet = $result['result'];

while ($row = $resultSet->fetch_assoc()) {
       $deleteWatchlistFromProduct = "DELETE FROM `watchlist` WHERE `id`=?";
       $db->execute_query($deleteWatchlistFromProduct, 'i', array($row['id']));
}

try {
       $deleteQuery = "DELETE FROM `product` WHERE `product_id`=?";
       $db->execute_query($deleteQuery, 's', array($productId));

       $responseObject->status = 'success';
       response_sender::sendJson($responseObject);
} catch (mysqli_sql_exception $e) {
       $responseObject->error = "Cannot delete product because it is still being used by a Set Toppings or Product Items or Promotions";
       // $responseObject->error = $e->getMessage();
       response_sender::sendJson($responseObject);
}
