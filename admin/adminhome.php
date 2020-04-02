<?php
session_start();

if(!isset($_SESSION["username"])) {
  header("Location: /cms/public/home.php");
  exit();
}

if(isset($_GET["lo"]) && $_GET["lo"] == 1) {
  $_SESSION["username"] = NULL;
  $_SESSION["id"] = NULL;
  session_destroy();
  header("Location: /cms/public/home.php");
  exit();
}

?>

<?php  require_once("../private/components/init.php");?>
<?php  require_once("../private/components/specdata.php");?>

<?php
if(isset($_GET["dr"]) && $_GET["dr"] == 1) {
  $id = $_GET["id"];
  $sql = "DELETE FROM specimens WHERE id =" . $id;
  $mysqli->query($sql);
  header("Location: /cms/admin/adminhome.php?drsuccess=1");
  exit();
}
?>

<?php $page_title = "Admin Home"?>

<?php require_once(COMPONENTS_PATH . "/header.php")?>

<div class="content-admin">

  <table class="table">
    <h3 class="table-title">Specimens</h3>
    <a href="/cms/admin/admincreatespec.php">Create New Specimen</a>
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Length</th>
        <th scope="col">Color</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    <thead>
    <tbody>

        <?php while($row = $stmt->fetch_assoc()) { ?>
          <tr>
            <td><?php echo htmlspecialchars($row["id"]);?></td>
            <td><?php echo htmlspecialchars($row["name"]);?></td>
            <td><?php echo htmlspecialchars($row["length"]);?></td>
            <td><?php echo htmlspecialchars($row["color"]);?></td>
            <td><a href="<?php echo "/cms/admin/adminviewspec.php?id=" . $row["id"];?>">View</a></td>
            <td><a href="<?php echo "/cms/admin/admineditspec.php?id=" . $row["id"];?>">Edit</a></td>
            <td><a href="<?php echo "/cms/admin/adminhome.php?dr=1&id=" . $row["id"];?>">Delete</a></td>
          </tr>
          <?php } ?>
    </tbody>
  </table>


  <div class="logout-wrapper">
    <div class="idinfo-wrapper">
      <small>User: <?php echo $_SESSION["username"];?></small>
      <small>User id: <?php echo $_SESSION["id"];?></small>
    </div>
    <a href="/cms/admin/adminhome.php?lo=1" class="btn btn-secondary logout-button">Logout</a>
  </div>

</div>

<?php require_once(COMPONENTS_PATH . "/footer.php"); ?>
