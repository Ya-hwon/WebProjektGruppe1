<?php
  include('src/php/read.php');
  include('./header.php');
  function newsHandler($num, $row, $data){
    if($num<>4||$row==1)return;
    echo '<div class="news-wrapper">
       <h3>'.$data[0].'</h3>
       <p>'.$data[1].'</p>'.
       ($temp = empty($data[2])?'':
       '<button href="'.$data[2].'" class="btn btn-primary">'.$data[3].'</button>')
    .'</div>';
  }
  function eventHandler($num, $row, $data){
    if($num<>5||$row==1)return;
    echo '<div class="event-wrapper">
       <div class="event-wrapper--short">
          <p>'.substr($data[1],0,5).'</p>
          <img src="./src/icon/calendar.svg"/>
       </div>
       <div class="event-wrapper--detail">
          <h3>'.$data[0].'</h3>
          <p>'.$data[1].'</p>
          <p>'.$data[2].'</p>'.
          ($temp = empty($data[3])?'':
          '<button href="'.$data[3].'" class="btn btn-primary">'.$data[4].'</button>')
       .'</div>
    </div>';
  }

?>
<link rel="stylesheet" href="src/css/index.css">
<main>
   <div class="container-hero">
      <div class="container-hero-inner">
         <p class="container-hero--callout__first">Wir lassen Sie nicht <br/> im Regen stehen</p>
         <p class="container-hero--callout__second">Bei uns finden Sie zur rechtliche Betreuung und Vorsorge</p>
         <button class="btn-primary">Zu unseren Angeboten</button>
      </div>
   </div>
   <section>
      <div class="card" style="width: 18rem;">
         <img class="card-img-top" src="..." alt="Card image cap">
         <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
         </div>
      </div>
   </section>
   <section class="section-news">
      <h2>Aktuelle Informationen</h2>
      <?php
        readFromCSV("aktuelles.csv",'newsHandler');
      ?>
   </section>
   <section>
      <h2>Veranstaltungskalender</h2>
      <?php
        readFromCSV("termine.csv",'eventHandler')
      ?>
   </section>
</main>
<?php
   include('./footer.php');
   ?>
