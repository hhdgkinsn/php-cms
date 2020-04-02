<?php
session_start();
if(isset($_SESSION["username"])) {
  header("Location: /cms/admin/adminhome.php");
  exit();
}

?>

<?php  require_once("../private/components/init.php")?>

<?php $page_title = "Home"?>
<?php require_once(COMPONENTS_PATH . "/header.php"); ?>

<div class="content">

  <ul class="page-menu">
    <a href="<?php echo PUBLIC_ROOT . "/home.php"?>"><li>Home</li></a>
    <a href="<?php echo PUBLIC_ROOT . "/viewspec.php";?>"><li>View Specimens</li></a>
  </ul>

  <form class="register-form" action="/cms/private/inc/reg.inc.php" method="post">
    <h4>Register</h4>
    <small class="text-danger"><?php
      if(isset($_GET["errempty"])) {
        echo "Please enter your information.";
      } elseif(isset($_GET["errusertaken"])) {
        echo "Username already taken.";
      }
    ?></small>
    <input class="form-control" type="text" name="username" placeholder="Username" data-toggle="tooltip" data-placement="right" title="Usernames must be at least 6 characters long."
    value="<?php
    if(isset($_GET["user"])) {
      echo $_GET["user"];
    }
    ?>">
    <small class="text-danger"><?php
      if(isset($_GET["erru"])) {
        echo "Please enter a valid username";
      }
    ?></small>
    <input class="form-control" type="password" name="password" placeholder="Password" data-toggle="tooltip" data-placement="right" title="Passwords must be at least 8 characters long.">
    <small class="text-danger"><?php
      if(isset($_GET["errp"])) {
        echo "Invalid Password";
      } elseif(isset($_GET["erremptyp"])) {
        echo "Please enter a password.";
      }
    ?></small>
    <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password">
    <small class="text-danger"><?php
      if(isset($_GET["errcp"])) {
        echo "Passwords do not match.";
      } elseif(isset($_GET["errnocp"])) {
        echo "Please confirm your password.";
      }
    ?></small>
    <input class="btn btn-primary submit-button" type="submit" name="register_submit">
  </form>

  <form class="login-form" action="/cms/private/inc/login.inc.php" method="post">
    <h4>Admin Login</h4>
    <input class="form-control" type="text" name="username">
    <input class="form-control" type="password" name="password">
    <input class="btn btn-primary submit-button" type="submit" name="login_submit">
  </form>

</div>


<?php require_once(COMPONENTS_PATH . "/footer.php"); ?>
