<?php

require_once("../private/components/init.php");

$sql = "SELECT * FROM specimens";

$stmt = $mysqli->query($sql);
