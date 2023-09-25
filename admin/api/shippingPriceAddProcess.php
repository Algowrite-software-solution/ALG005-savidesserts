<?php

//shipping price adding
//by Nisal uthsara
//version - 1.0.1
//21-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response 
$responseObject = new stdClass();
$responseObject->status = 'false';

//cheak is login user
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
    $responseObject->status = "Please LogIn";
    response_sender::sendJson($responseObject);
}

//use the POST method
$ship_price = $_POST['shippingPrice'];
$weight = $_POST['weightId'];

$db = new database_driver();


//Cheaking if there are already have weight and price
$searchQuery = "SELECT * FROM `shipping_price` WHERE `price`=? AND `weight_id`=?";
$resultSetShipPrice = $db->execute_query($searchQuery, 'ss', array($ship_price, $weight));


if ($resultSetShipPrice['result']->num_rows > 0) {
    $responseObject->error = 'Already Added this price for the weight';
    response_sender::sendJson($responseObject);
} else {
    //adding price
    $insertQuery = "INSERT INTO `shipping_price`(`price`,`weight_id`) VALUES (?,?)";
    $db->execute_query($insertQuery, 'ss', array($ship_price, $weight));
    $responseObject->status = 'Shipping price added successfully';
    response_sender::sendJson($responseObject);
}

?>