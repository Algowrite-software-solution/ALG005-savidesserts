<?php
//extra table delete API
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
if (!RequestHandler::isPostMethod()) {
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
$extraId = $_POST['extra_id'];

//delete all Topping in cart
$searchToppingsCart = "SELECT * FROM `card` WHERE `extra_id`=?";
$result = $db->execute_query($searchToppingsCart, 'i', array($extraId));

$resultSet = $result['result'];

while ($row = $resultSet->fetch_assoc()) {
       $deleteCartFromToppings = "DELETE FROM `card` WHERE `id`=?";
       $db->execute_query($deleteCartFromToppings, 'i', array($row['id']));
}

try {
       $db = new database_driver();
       $deleteQuery = "DELETE FROM `extra` WHERE `id`=?";
       $db->execute_query($deleteQuery, 'i', array($extraId));

       $responseObject->status = 'success';
       response_sender::sendJson($responseObject);
       
} catch (mysqli_sql_exception $ex) {

       if ($ex->getMessage() === "Cannot delete or update a parent row: a foreign key constraint fails (`savi_dessert_shop`.`extra_item`, CONSTRAINT `fk_extra_item_extra1` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id`))") {
              $responseObject->error = "Cannot delete this Toppings because it is still being used by a set Toppings";
              response_sender::sendJson($responseObject);
       }
}
