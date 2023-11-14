<?php
// /include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//check is login user
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please Sign In';
     response_sender::sendJson($responseObject);
}

$province = $_POST['province'];
$district = $_POST['district'];
$fullName = $_POST['fullName'];
$mobile = $_POST['mobile'];
$addressLine1 = $_POST['addressLine1'];
$addressLine2 = $_POST['addressLine2'];
$city = $_POST['city'];
$postCode = $_POST['postCode'];

$userData = $userCheckSession->getUserId();
$userId = $userData["user_id"];


if (empty($province) || $province === 0) {
     $responseObject->error = 'Please select the province';
     response_sender::sendJson($responseObject);
}

if (empty($district) || $district === 0) {
     $responseObject->error = 'Please select the district';
     response_sender::sendJson($responseObject);
}

if (empty($fullName)) {
     $responseObject->error = 'Please enter the full name';
     response_sender::sendJson($responseObject);
}

if (empty($mobile)) {
     $responseObject->error = 'Please enter the  mobile';
     response_sender::sendJson($responseObject);
}

if (empty($addressLine1)) {
     $responseObject->error = 'Please enter the  address line 1';
     response_sender::sendJson($responseObject);
}

if (empty($city)) {
     $responseObject->error = 'Please enter the city';
     response_sender::sendJson($responseObject);
}
if (empty($postCode)) {
     $responseObject->error = 'Please enter the post code';
     response_sender::sendJson($responseObject);
}


$db = new database_driver();
$dataSearch = "SELECT * FROM `delivery_details` WHERE `user_user_id`=?";
$resultSet = $db->execute_query($dataSearch, 'i', array($userId));

$result = $resultSet['result'];
if ($result->num_rows > 0) {
     $query = "UPDATE `delivery_details` SET `address_line_1`=?,`address_line_2`=?,`mobile`=?,`province_province_id`=?,`distric_distric_id`=?,`city`=?,`postal_code`=? WHERE `user_user_id`=?";
     $db->execute_query($query, 'ssssssss', array($addressLine1, $addressLine2, $mobile, $province, $district, $city, $postCode, $userId));
     $responseObject->status = 'success';
     response_sender::sendJson($responseObject);
}

$dataAdd = "INSERT INTO `delivery_details` (`address_line_1`,`address_line_2`,`mobile`,`province_province_id`,`distric_distric_id`,`city`,`postal_code`,user_user_id) VALUES (?,?,?,?,?,?,?,?)";
$db->execute_query($dataAdd, 'ssssssss', array($addressLine1, $addressLine2, $mobile, $province, $district, $city, $postCode, $userId));

//user name if change
$nameChangeQuery = "UPDATE `user` SET `full_name`=? WHERE `user_id`=?";
$db->execute_query($nameChangeQuery, 'ss', array($fullName, $userId));

$responseObject->status = 'success';
response_sender::sendJson($responseObject);
