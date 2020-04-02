<?php
session_start();

if(!isset($_SESSION["username"])) {
  header("Location: /cms/public/home.php");
  exit();
}
?>

<?php  require_once("../private/components/init.php");?>

<?php $page_title = "View Specimen"?>

<?php require_once(COMPONENTS_PATH . "/header.php")?>

<div class="content-admin">
  <?php
    $id = $_GET["id"];

    $sql = "SELECT * FROM specimens WHERE id=?";
    if(!$stmt = $mysqli->prepare($sql)) {
      header("Location: /cms/admin/adminhome.php?err=sqlerr");
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
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Color</th>
        <th scope="col">Length</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $row["id"];?></td>
        <td><?php echo $row["name"];?></td>
        <td><?php echo $row["color"];?></td>
        <td><?php echo $row["length"];?></td>
      </tr>
    <tbody>
  </table>
</div>

<?php require_once(COMPONENTS_PATH . "/footer.php"); ?>
