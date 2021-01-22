<?php
session_start();
if(!isset($_SESSION['login'])) {
  header('LOCATION:adminLogin.php'); die();
}
include('src/php/read.php');
include('./header.php');

function adminHandler($num, $row, $data){
  if($row==1){
    echo '<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>';
        for ($c=0; $c < $num; $c++) {
          echo '<th scope="col">'.$data[$c].'</th>';
        }
    echo '</tr>
    </thead>
    <tbody>';
    return;
  }
  echo '<tr><th scope="row">'.($row-1).'</th>';
  for ($c=0; $c < $num; $c++) {
    echo '<td contenteditable="true">'.$data[$c].'</td>';
  }
  echo '</tr>';
}

?>

<main>
<h2>Admin Page</h2>
<?php
echo '<h3>Termine</h3>';
readFromCSV('termine.csv', 'adminHandler');
echo '</tbody>
</table>';
echo '<h3>Aktuelles</h3>';
readFromCSV('aktuelles.csv', 'adminHandler');
echo '</tbody>
</table>';
echo '<h3>Mitarbeiter</h3>';
readFromCSV('mitarbeiter.csv','adminHandler');
echo '</tbody>
</table>';

 ?>
</main>


<?php
include('./footer.php');
?>
