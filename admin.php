<?php
session_start();
if(!isset($_SESSION['login'])) {
  header('LOCATION:adminLogin'); die();
}
if(!empty($_POST["saveData"])) {
	$data = json_decode($_POST["saveData"]);
  $list=-1;
  $lists=array();
  $entry=0;
  foreach($data as $elem){
    if($elem=="#"){
      $list++;
      $entry=0;
      $lists[$list][0]=array();
      continue;
    }
    if(is_numeric($elem)){
      $entry++;
      $lists[$list][]=array();
      continue;
    }
    $lists[$list][$entry][]=$elem;
  }

  $file = fopen("src/csv/termine.csv", "w");
  foreach($lists[0] as $sublist){
    fputcsv($file,$sublist);
  }
  fclose($file);
  $file = fopen("src/csv/aktuelles.csv", "w");
  foreach($lists[1] as $sublist){
    fputcsv($file,$sublist);
  }
  fclose($file);
  $file = fopen("src/csv/mitarbeiter.csv", "w");
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
  echo '<td><button class="toremove" onclick="$(this).parent().parent().remove();renewAllIndices();">Remove</button></td></tr>';
}

?>
<main>
<h2>Admin Page</h2>
<script type="text/javascript">
  function append(index){
    $(".table")[index].tBodies[0].append($(".table")[index].tBodies[0].lastElementChild.cloneNode(true));
    $(".table")[index].tBodies[0].lastElementChild.firstElementChild.innerHTML=$(".table")[index].tBodies[0].lastElementChild.rowIndex;
  }
  function renewAllIndices(){
    $("tbody>tr>th:first-child").each(function(){$(this).text($(this).parent().index()+1);});
  }
</script>
<a href="/src/php/logout.php"><button>Logout</button></a>
<?php
echo '<h3>Termine</h3><button onclick="append(0);">Add</button>';
readFromCSV('termine.csv', 'adminHandler');
echo '</tbody>
</table>';
echo '<h3>Aktuelles</h3><button onclick="append(1);">Add</button>';
readFromCSV('aktuelles.csv', 'adminHandler');
echo '</tbody>
</table>';
echo '<h3>Mitarbeiter</h3><button onclick="append(2);">Add</button>';
readFromCSV('mitarbeiter.csv','adminHandler');
echo '</tbody>
</table>';
?>

 <button id="saveCSVs" onclick="(function save(){
   var elems = new Array;
   $('.toremove').parent().remove();
   $('th, td').each(function(index){elems.push($(this).text());});
   $('#hiddenInput').val(JSON.stringify(elems));
   $('#hiddenForm').submit();
 })();"
 >speichern</button>
 <form method="POST" action="" name="save" id="hiddenForm">
   <input type="hidden" id="hiddenInput" name="saveData" value=""/>
 </form>

</main>


<?php
include('./footer.php');
?>
