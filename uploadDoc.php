<?php
  include('./head.php');
?>
</head>

<?php
session_start();
if(!isset($_SESSION['login'])) {
  header('LOCATION:adminLogin'); die();
}
if(!empty($_POST['delete'])){
  unlink("src/doc/upload/".$_POST['filename']);
  header("Refresh:5");
}

include('./header.php');
?>
<main>
<h2>Admin Page</h2>

<a href="./admin"><button class="btn btn-primary">Zum Admin Bereich</button></a>
<a href="/src/php/logout.php"><button class="btn btn-primary">Logout</button></a>
<br><br>
<form enctype="multipart/form-data" method="POST">
    <p>Datei hochladen</p>
    <input type="file" name="uploaded_file"></input>
    <input type="submit" value="Hochladen"></input>
</form>

<?php

if(!empty($_FILES['uploaded_file'])){
  $path = "src/doc/upload/";
  $path = $path . basename( $_FILES['uploaded_file']['name']);

  if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {

  }
}

$list = array_diff(scandir("src/doc/upload/", SCANDIR_SORT_ASCENDING), array('.', '..'));

if(!empty($list)){
  echo '<br><br><br><table><tr><th>Dateiname</th><th>Löschen?</th></tr>';
  foreach($list as $entry){
    echo '<tr><td onclick="navigator.clipboard.writeText(\'./src/doc/upload/'.$entry.'\');">'.$entry.'</td><td><form method="POST"><input style="display:none" type="text" name="filename" value="'.$entry.'"><input type="submit" name="delete" class="button" value="Löschen"></input></form></td></tr>';
  }
  echo '</table>';
}

?>

</main>

<?php
include('./footer.php');
?>
