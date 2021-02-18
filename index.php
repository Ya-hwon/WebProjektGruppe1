<?php
  include('./head.php');
?>
<link rel="stylesheet" href="src/css/index.css">
</head>
<?php
  include('./header.php');
  include('src/php/read.php');
  function newsHandler($num, $row, $data){
    if($num<>4||$row==1)return;
    echo '<div class="news-wrapper">
       <h3>'.$data[0].'</h3>
       <p>'.$data[1].'</p>'.
       (empty($data[2])?'':
       '<a href="'.$data[2].'"><button class="btn btn-primary">'.$data[3].'</button></a>')
    .'</div>';
  }
  function eventHandler($num, $row, $data){
    if($num<>5||$row==1)return;
    echo '<div class="event-wrapper">
       <div class="event-wrapper--short">
          <p>'.substr($data[1],0,5).'</p>
          <img src="./src/icon/calendar.svg" alt="Icon eines Kalenderblatts"/>
       </div>
       <div class="event-wrapper--detail">
          <h3>'.$data[0].'</h3>
          <p>'.$data[1].'</p>
          <p>'.$data[2].'</p>'.
          (empty($data[3])?'':
          '<a href="'.$data[3].'"><button class="btn btn-primary">'.$data[4].'</button></a>')
       .'</div>
    </div>';
  }

?>
<main>
   <div class="container-hero">
      <div class="container-hero-inner">
         <p class="container-hero--callout__first">Wir lassen Sie nicht <br/> im Regen stehen</p>
         <p class="container-hero--callout__second">Bei uns finden Sie Hilfe zur rechtliche Betreuung und Vorsorge</p>
         <a href="./betreuung"><button class="btn-primary">Zu unseren Angeboten</button></a>
      </div>
   </div>
   <section class="section-cards">
      <div class="card">
         <img class="card-img-top" src="./src/img/unserVerein.jpg" alt="Bild einer Vereinsversammlung des BTV Heidenheim">
         <div class="card-body">
            <h2 class="card-title">Unser Verein</h2>
            <p class="card-text">Hier erfahren Sie mehr über uns oder können unserem Verein beitreten</p>
            <a href="./unserVerein" class="btn btn-primary">Mehr erfahren</a>
         </div>
      </div>

       <div class="card">
         <img class="card-img-top" src="./src/img/betreuung.jpg" alt="Zwei Menschen auf einem Bild das Pflege symbolisieren soll">
         <div class="card-body">
            <h2 class="card-title">Betreuung</h2>
            <p class="card-text">Hier erhalten Sie Informationen rund um das Thema Betreuung</p>
            <a href="./betreuung" class="btn btn-primary">Mehr erfahren</a>
         </div>
      </div>

    <div class="card">
         <img class="card-img-top" src="./src/img/vorsorge.jpg" alt="Eine Hand eines älteren Menschen unterschreibt einen Vertrag">
         <div class="card-body">
            <h2 class="card-title">Vorsorge</h2>
            <p class="card-text">Sie möchten selbstbestimmt vorsorgen ? Hier erhalten Sie mehr Informationen zum Thema Vorsorge</p>
            <a href="./vorsorge" class="btn btn-primary">Mehr erfahren</a>
         </div>
      </div>
   </section>
   <section class="section-news">
      <h2>Neuigkeiten</h2>
      <?php
        readFromCSV("aktuelles.csv",'newsHandler');
      ?>
   </section>
   <section>
      <h2>Veranstaltungen</h2>
      <?php
        readFromCSV("termine.csv",'eventHandler')
      ?>
   </section>
    <section class="section-memberships">
        <h2>Unsere Mitgliedschaften</h2>
        <div class="section--inner">
            <a href="https://www.igbetreuungsvereine-bw.de/" target="_blank"><img src="./src/img/IG_Betreuungsvereine_Logo.jpg"  alt="Logo der IG Betreuungsvereine in Baden Wuettemberg"></a>
            <a href="https://www.diakonie-wuerttemberg.de/" target="_blank"><img src="./src/img/Diakonie_Wuerttemberg_Logo.jpg" alt="Logo der Diakonie Baden Wuettemberg"></a>
        </div>

    </section>
    <section class="section-support">
        <h2>Wir werden gefördert durch</h2>
        <div class="section--inner">
           <a href="https://www.landkreis-heidenheim.de/" target="_blank"> <img src="./src/img/lrahdh_logo.png"  alt="Logo des Landratsamt Heidenheim"></a>
            <a href="https://sozialministerium.baden-wuerttemberg.de/de/startseite/" target="_blank"><img src="./src/img/logo-bawue.png"  alt="Logo des Sozialministeriums Baden Wuerttemberg"></a>
        </div>
    </section>
</main>
<?php
   include('./footer.php');
   ?>
