<?php

require_once("../components/init.php");

if(!$_SERVER["REQUEST_METHOD"] == "POST") {
  header("Location: /cms/public/home.php");
  exit();
}else {
   $username = $_POST["username"];
   $password = $_POST["password"];

   $sql =  "SELECT * FROM users WHERE username = ?";
   if(!$stmt = $mysqli->prepare($sql)) {
     header("Location: /cms/public/home.php?err=sqlerror");
     exit();
   } else {
     $stmt->bind_param("s", $username);
     $stmt->execute();
     $resultobj = $stmt->get_result();
     if(!$row = $resultobj->fetch_assoc()) {
       header("Location: /cms/public/home.php?err=nouser");
       exit();
     } else {
       $verified_pass = password_verify($password, $row["password"]);
       if($verified_pass == false) {
         header("Location: /cms/public/home.php?err=invalidpass");
         exit();
       } elseif($verified_pass == true) {
         session_start();
         $_SESSION["id"] = $row["id"];
         $_SESSION["username"] = $row["username"];
         header("Location: /cms/admin/adminhome.php");
       } else {
         header("Location: /cms/public/home.php?err=invalidpass");
         exit();
       }

       }

       }
     }
