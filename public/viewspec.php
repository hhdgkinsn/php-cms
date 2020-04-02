<?php  require_once("../private/components/init.php")?>

<?php $page_title = "Specimens"?>

<?php require_once(COMPONENTS_PATH . "/header.php")?>

<div class="content">
<?php
  $sql = "SELECT * FROM specimens";
  $stmt = $mysqli->query($sql);
?>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Color</th>
        <th scope="col">Length</th>
      <tr>
    <thead>
    <tbody>
      <?php while($row = $stmt->fetch_assoc()) {?>
      <tr>
          <td><?php echo $row["id"];?></td>
          <td><?php echo $row["name"];?></td>
          <td><?php echo $row["color"];?></td>
          <td><?php echo $row["length"];?></td>
      </tr>
      <?php } ?>
    <tbody>
  </table>

</div>

<?php require_once(COMPONENTS_PATH . "/footer.php"); ?>
