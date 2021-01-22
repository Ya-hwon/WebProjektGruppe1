<?php
session_start();
if(!isset($_SESSION['login'])) {
  header('LOCATION:adminLogin.php'); die();
}

if(!empty($_POST["saveData"])) {
  echo "<html></html>";
	$data = json_decode($_POST["saveData"]);
  $list=-1;
  $lists=array();
  foreach($data as $elem){
    if($elem=="#"){
      $list++;
      if($list>2)break;
      $lists[$list]=array();
    }
    if(is_numeric($elem))continue;
    $lists[$list][]=$elem;
  }

  $file = fopen("termine.csv", "w");
  foreach($lists[0] as $sublist){
    fputcsv($file,$sublist);
  }
  fclose($file);
  $file = fopen("aktuelles.csv", "w");
  foreach($lists[1] as $sublist){
    fputcsv($file,$sublist);
  }
  fclose($file);
  $file = fopen("mitarbeiter.csv", "w");
  foreach($lists[2] as $sublist){
    fputcsv($file,$sublist);
  }
  fclose($file);
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

function saveCSV(){

  /* TODO: note this wont work, i have to react to post event with data from save js function
    file = fopen(filename, 'w')
    possibly: foreach(gesamtliste as teilliste)fputcsv(file, teilliste)
    fputcsv(file,arrayofvalues)
    fclose(file)
  */
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

saveCSV();

 ?>

 <button id="saveCSVs" onclick="(function save(){
   var elems = new Array;
   document.querySelectorAll('th,td').forEach(e => elems.push(e.innerText));
   document.getElementById('hiddenInput').value=JSON.stringify(elems);
   document.getElementById('hiddenForm').submit();
 })();"
 >speichern</button>
 <form method="POST" action="" name="save" id="hiddenForm">
   <input type="hidden" id="hiddenInput" name="saveData" value=""/>
 </form>

</main>


<?php
include('./footer.php');
?>
