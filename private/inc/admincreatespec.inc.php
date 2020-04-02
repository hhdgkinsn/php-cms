<?php

require_once("../components/init.php");

if(!$_SERVER["REQUEST_METHOD"] == "POST") {
  header("Location: /cms/admin/admincreatespec.php");
  exit();
} else {
  $spec_name = $_POST["spec_name"];
  $spec_color = $_POST["spec_color"];
  $spec_length = $_POST["spec_length"];


  if(empty($spec_name) || empty($spec_color) || empty($spec_length)) {
    header("Location: /cms/admin/admincreatespec.php?err=emptyfields");
    exit();
  } elseif($spec_length < 0) {
    header("Location: /cms/admin/admincreatespec.php?err=lengtherr");
    exit();
  } else {
    $sql = "INSERT INTO specimens (name, color, length) VALUES (?,?,?)";
    if(!$stmt = $mysqli->prepare($sql)) {
      header("Location: /cms/admin/admincreatespec.php?err=sqlerr");
      exit();
    } else {
      $stmt->bind_param("sss", $spec_name, $spec_color, $spec_length);
      $stmt->execute();
      header("Location: /cms/admin/adminhome.php");


      }
  }
}
