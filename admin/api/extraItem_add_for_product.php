<?php
//extra Item Adding API
//by madusha pravinda
//version - 1.0.2 (last updated - 18-10-2023)
//26-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/data_validator.php");
require_once("../../backend/model/RequestHandler.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'failed';

//database object
$db = new database_driver();

//data update and add extra item
if (RequestHandler::isPostMethod()) {

     // chekcing is user logging
     $userCheckSession = new SessionManager("alg005_admin");
     if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
          $responseObject->error = 'Please LogIn';
          response_sender::sendJson($responseObject);
     }

     //data add extra item
     if (isset($_POST['ad_product_id']) && isset($_POST['ad_extra_id'])) {
          // input data
          $product_id = $_POST['ad_product_id'];
          $extra_id = $_POST['ad_extra_id'];

          //validation data
          $validateReadyObject = (object) [
               "int_or_null" => [
                    (object) ["datakey" => "product id", "value" => $product_id],
                    (object) ["datakey" => "extra id", "value" => $extra_id],
               ],
          ];

          //validation data 
          $validator = new data_validator($validateReadyObject);
          $errors = $validator->validate();
          foreach ($errors as $key => $value) {
               if ($value) {
                    $responseObject->error = "Invalid Input for : " . $key;
                    response_sender::sendJson($responseObject);
               }
          }

          //add extra item for product
          $searchQuery = "SELECT * FROM `extra_item` WHERE `extra_id`=? AND `product_product_id`=?";
          $result = $db->execute_query($searchQuery, 'ii', array($extra_id, $product_id));

          //result already have script close
          if ($result['result']->num_rows > 0) {
               $responseObject->error = 'this product item already set';
               response_sender::sendJson($responseObject);
          }

          //add data
          $insertData = "INSERT INTO `extra_item` (`extra_id`,`product_product_id`) VALUES (?,?)";
          $db->execute_query($insertData, 'ii', array($extra_id, $product_id));
          $responseObject->status = 'success';
          response_sender::sendJson($responseObject);
     }

     //data update extra item
     if (isset($_POST['up_product_id'], $_POST['up_extra_id'], $_POST['up_extraItem_id'])) {
          // input data
          $up_product_id = $_POST['up_product_id'];
          $up_extra_id = $_POST['up_extra_id'];
          $up_extraItem_id = $_POST['up_extraItem_id'];

          //validation data
          $validateReadyObject = (object) [
               "int_or_null" => [
                    (object) ["datakey" => "product id", "value" => $up_product_id],
                    (object) ["datakey" => "extra id", "value" => $up_extra_id],
                    (object) ["datakey" => "extra id", "value" => $up_extraItem_id],
               ],
          ];

          //validation data 
          $validator = new data_validator($validateReadyObject);
          $errors = $validator->validate();
          foreach ($errors as $key => $value) {
               if ($value) {
                    $responseObject->error = "Invalid Input for : " . $key;
                    response_sender::sendJson($responseObject);
               }
          }


          //add data
          $insertData = "UPDATE `extra_item` SET `extra_id`=?,`product_product_id`=? WHERE `id`=?";
          $db->execute_query($insertData, 'iii', array($up_extra_id, $up_product_id, $up_extraItem_id));
          $responseObject->status = 'success';
          response_sender::sendJson($responseObject);
     }
}

//get all data
if (RequestHandler::isGetMethod()) {

     // chekcing is user logging
     $userCheckSession = new SessionManager("alg005_admin");
     if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
          $responseObject->error = 'Please LogIn';
          response_sender::sendJson($responseObject);
     }

     //load all extra item
     $searchTable = "SELECT * FROM `extra_item` INNER JOIN `extra` ON `extra_item`.`extra_id`=`extra`.`id` INNER JOIN `product` ON `extra_item`.`product_product_id`=`product`.`product_id`";
     $result = $db->query($searchTable);

    //response data array 
     $resultArray = [];

     //check row data
     if ($result->num_rows < 0) {
          $responseObject->error = 'no data';
          response_sender::sendJson($responseObject);
     }

     //get data
     while ($rowData = $result->fetch_assoc()) {
          array_push($resultArray, $rowData);
     }

     $responseObject->status = 'success';
     $responseObject->result = $resultArray;
     response_sender::sendJson($responseObject);
     //load all extra item

}
