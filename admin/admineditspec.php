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

  <?php
  $id = $_GET["id"];
  $sql = "SELECT * FROM specimens WHERE id=?";
  if(!$stmt = $mysqli->prepare($sql)) {
    header("Location: /cms/admin/admineditspec.php");
    exit();
  } else {
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
  }

  ?>

  <div class="back-wrapper">
    <a href="/cms/admin/adminhome.php" class="btn btn-secondary back-button">&#8592; back</a>
  </div>

  <form action="../private/inc/admineditspec.inc.php" method="post">
    <h3>Edit Specimen</h3>
    <input style="display:none;" type="text" name="spec_id" value="<?php echo $id; ?>">
    <input class="form-control" type="text" name="spec_name" placeholder="Name"
    value="<?php echo $row["name"];?>">
    <input class="form-control" type="text" name="spec_color" placeholder="Color"
    value="<?php echo $row["color"];?>">
    <label>Length (mm)</label>
    <input class="form-control" type="number" name="spec_length"
    value="<?php echo $row["length"];?>">
    <input class="btn btn-primary submit-button" type="submit" name="submit">
  </form>

</div>

<?php require_once(COMPONENTS_PATH . "/footer.php"); ?>
