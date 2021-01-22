<?php
include('src/php/read.php');
include('./header.php');
function mitarbeiterHandler($num, $row, $data){
  if($num<>7||$row==1)return;
      echo '<div class="card mb-3" style="max-width: 540px">
        <div class="row g-0">
          <div class="col-md-4">
            <img
              src="src/img/'.$data[2].'"
              alt="'.$data[3].'"
              class="img-fluid"/>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h4 class="card-title">'.$data[0].'</h4>
              <p class="card-subtitle">'.$data[1].'</p>
              <p class="card-text">
                Tel.: '.$data[5].'<br/>
                Fax: '.$data[6].'</p>
                <button type="button" class="btn btn-primary">Email</button>
            </div>
          </div>
        </div>
      </div>';
}
?>

<link rel="stylesheet" href="src/css/unserverein.css">

<main>
    <h2>Mitarbeiter</h2>

<?php
  readFromCSV("mitarbeiter.csv",'mitarbeiterHandler');
?>

<h2><br/>Vorstand</h2>
<img id="photo-vorstand" src="src/img/vorstand.jpg" alt="Gruppenfoto des Vorstands">

</main>


<?php
include('./footer.php');
?>
