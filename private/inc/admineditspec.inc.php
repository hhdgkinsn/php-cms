<?php

require_once("../components/init.php");

if(!$_SERVER["REQUEST_METHOD"] == "POST") {
  header("Location: /cms/admin/admineditspec.php");
  exit();
} else {
  $spec_id = $_POST["spec_id"];
  $spec_name = $_POST["spec_name"];
  $spec_color = $_POST["spec_color"];
  $spec_length = $_POST["spec_length"];

  if(empty($spec_name) || empty($spec_color) || empty($spec_length)) {
    header("Location: /cms/admin/admineditspec.php?err=emptyfields");
    exit();
  } elseif($spec_length < 0) {
    header("Location: /cms/admin/admineditspec.php?err=invalidlength");
    exit();
  } else {
    $sql = "UPDATE specimens SET name=?,color=?,length=? WHERE id=?";
    if(!$stmt = $mysqli->prepare($sql)) {
      header("Location: /cms/admin/admineditspec.php?err=sqlerr");
      exit();
    } else {
      $stmt->bind_param("sssi", $spec_name, $spec_color, $spec_length, $spec_id);
      $stmt->execute();
      header("Location: /cms/admin/adminhome.php");
    }
  }


}
