<?php
session_start();

if(!isset($_SESSION["username"])) {
  header("Location: /cms/public/home.php");
  exit();
}
?>

<?php  require_once("../private/components/init.php");?>

<?php $page_title = "Create Specimen"?>

<?php require_once(COMPONENTS_PATH . "/header.php")?>

<div class="content-admin">

  <div class="back-wrapper">
    <a href="/cms/admin/adminhome.php" class="btn btn-secondary back-button">&#8592; back</a>
  </div>

  <form action="../private/inc/admincreatespec.inc.php" method="post">
    <h3>New Specimen</h3>
    <input class="form-control" type="text" name="spec_name" placeholder="Name">
    <input class="form-control" type="text" name="spec_color" placeholder="Color">
    <label>Length (mm)</label>
    <input class="form-control" type="number" name="spec_length" value="0">
    <input class="btn btn-primary submit-button" type="submit" name="submit">
  </form>

</div>

<?php require_once(COMPONENTS_PATH . "/footer.php"); ?>
