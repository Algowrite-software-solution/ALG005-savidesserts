<?php
// access validator
require_once(__DIR__ . "/../backend/model/SessionManager.php");

$sessionManager = new SessionManager("alg005_admin");
if ($sessionManager->isLoggedIn()) {
    include_once(__DIR__ . "/dashboard.php");
} else {
    include_once(__DIR__ . "/signin.php");
}
