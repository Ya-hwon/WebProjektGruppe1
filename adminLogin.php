<?php
session_start();
if(isset($_SESSION['login'])) {
  header('LOCATION:admin'); die();
}
$error=false;
if(isset($_POST['submit'])){
  $password = $_POST['password'];
  if(password_verify($password, '$2y$10$AWfj64e4rVhmORIlWCtMSuLELGdCYrnZaOMAxwVORrVggHyh8.U3K')){
    $_SESSION['login'] = true; header('LOCATION:admin'); die();
  } else{
    $error=true; //meh
  }
}
include('./header.php');
?>

<main>
  <?php if($error)echo "<div class='alert alert-danger'>Error</div>"; ?>
  <div class="container">
  <h3 class="text-center">Login</h3>
  <form action="" method="post"><!--TODO: markup -->
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" name="password" required>
    </div>
    <button type="submit" name="submit" class="btn btn-default">Login</button>
  </form>
</div>
</main>


<?php
include('./footer.php');
?>
