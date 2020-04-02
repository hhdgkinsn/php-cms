<?php

require_once("../components/init.php");

if(!$_SERVER["REQUEST_METHOD"] == "POST") {
  header("Location: /cms/public/adminreg.php?err=no");
  exit();
} else {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];

  if(empty($username) && empty($password) && empty($confirm_password)) {
    header("Location: /cms/public/adminreg.php?errempty");
    exit();
  } elseif(strlen($username) < 6 && empty($password)) {
    header("Location: /cms/public/adminreg.php?erru&erremptyp");
    exit();
  } elseif(empty($password)) {
    header("Location: /cms/public/adminreg.php?erremptyp&user=" . $username);
    exit();
  } elseif (strlen($username) < 6) {
    header("Location: /cms/public/adminreg.php?erru");
    exit();
  } elseif(strlen($password) < 8 ) {
    header("Location: /cms/public/adminreg.php?errp&user=" . $username);
    exit();
  } elseif ($password != $confirm_password) {
    header("Location: /cms/public/adminreg.php?errcp&user=" . $username);
    exit();
  } elseif (empty($confirm_password)) {
    header("Location: /cms/public/adminreg.php?errnocp&user=" . $username);
    exit();
  } else {
    $sql = "SELECT username FROM users WHERE username = ?";

    if(!$stmt = $mysqli->prepare($sql)) {
      header("Location " . PUBLIC_ROOT . "/adminreg.php?error=sqlerr");
      exit();
    } else {
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $stmt->store_result();
      if($stmt->num_rows() > 0) {
        header("Location: /cms/public/adminreg.php?errusertaken");
        exit();
      } else {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        if(!$stmt = $mysqli->prepare($sql)) {
          header("Location " . PUBLIC_ROOT . "/adminreg.php?error=sqlerr");
          exit();
        } else {
          $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
          $stmt->bind_param("ss", $username, $hashed_pass);
          $stmt->execute();
          $user_id = $stmt->insert_id;
          session_start();
          $_SESSION["username"] = $username;
          $_SESSION["user_id"] = $user_id;
          header("Location: /cms/admin/adminhome.php");
          exit();
        }
      }
    }
  }


}
