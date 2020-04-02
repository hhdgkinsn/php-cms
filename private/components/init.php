<?php

// require_once("functions.php");

$mysqli = new mysqli("localhost", "root", "", "demo");

if($mysqli->connect_errno) {
  die("connection failed:" . $mysqli->connect_error);
}


define("COMPONENTS_PATH", dirname(__FILE__));
define("PRIVATE_PATH", dirname(COMPONENTS_PATH));
define("PUBLIC_PATH", dirname(PRIVATE_PATH) . "/public");

$public_end = strpos($_SERVER["PHP_SELF"], "/public") + 7;
$public_root = substr($_SERVER["PHP_SELF"], 0, $public_end);
define("PUBLIC_ROOT", $public_root);
