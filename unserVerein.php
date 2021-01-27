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
                <a href="mailto:'.$data[4].'"><button type="button" class="btn btn-primary">Email</button></a>
            </div>
          </div>
        </div>
      </div>';
}
?>

<link rel="stylesheet" href="src/css/unserverein.css">

<main>
<h2 id="Mitarbeiter">Mitarbeiter</h2>

<?php
  readFromCSV("mitarbeiter.csv",'mitarbeiterHandler');
?>

<h2 id="Vorstand">Vorstand</h2>
<img id="photo-vorstand" src="src/img/vorstand.JPG" alt="Gruppenfoto des Vorstands"> 
    
<div class="vorstand-wrapper">
<table class="table table-bordered">
  <tbody>
    <tr>
      <td><b>Sabine Dernai</b><br/>1. Vorsitzende</td>
      <td><b>Michael Rettenberger</b><br/>2. Vorsitzender</td>
    </tr>
    <tr>
      <td><b>Iris Mack</b><br/>Schatzmeisterin</td>
      <td><b>Anita Pfeiffer</b><br/>Schriftführerin</td>
    </tr>
    <tr>
      <td><b>Prof. Johannes Falterbaum</b><br/>Besitzer</td>
      <td><b>Josefine Bauer</b><br/>Besitzerin</td>
    </tr>
  </tbody>
</table>
</div>
    
<h2 id="Mitglied">Mitglied werden</h2>
<p><b>Möchten Sie Mitglied werden oder uns durch Ihre Spende unterstützen?</b><br/>
Auch ohne Übernahme einer ehrenamtlichen Betreuung können Sie unsere Arbeit durch Ihre Mitgliedschaft oder eine Spende unterstützen. Die Mitgliedschaft ist kostenlos.</p>
<div class="button-mitglied-wrapper">
    <a href="https://www.btv-hdh.de/mitgliedschaft.html"><button type="button" class="btn btn-primary">Mitglied werden</button></a>
    <a href="https://www.betterplace.org/de/projects/16164-qualifizierung-ehrenamtlicher-betreuerinnen-und-betreuer"><button type="button" class="btn btn-primary spenden-button">Spenden</button></a>
</div>
    
<h2 id="Mitarbeit">Mitarbeit</h2>
<p><b>Sie können es sich vostellen, ehrenamtlicher Betreuer zu werden?</b><br/>Mit einem Klick auf den folgenden Button können Sie sich weiter über die ehrenamtliche Betreuung informieren.</p>
<div class="button-mitglied-wrapper">
    <a href="https://www.btv-hdh.de/mitgliedschaft.html"><button type="button" class="btn btn-primary">Betreuer werden</button></a>
</div>
    
<h2>Satzung</h2>
<div class="satzung-wrapper">
    <a href="/src/doc/SATZ.pdf" download="vereinssatzung"><p><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
    </svg> Vereinssatzung.pdf</p></a>
</div>

</main>


<?php
include('./footer.php');
?>
