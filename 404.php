<?php
  include('./head.php');
?>
<style>
    main{
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    img{
        max-width: 80%;
    }
    
    .p5Canvas{
        position: relative !important;
        top: 0 !important;
        left: 0 !important;
    }
</style>
</head>

<?php
include('./header.php');

$records = file('./src/doc/highscores.txt', FILE_IGNORE_NEW_LINES);

function getPoints($str){
  return intval(substr($str, 0, strpos($str, ' ')));
}

if(!empty($_POST["hs"])){
  $data = $_POST["hs"];
  $pts = getPoints($data);
  for($i = 0; $i < count($records);$i++){
    if($pts > getPoints($records[$i])){
      for($a = count($records)-1;$a>$i;$a--){
        $records[$a]=$records[$a-1];
      }
      $records[$i]=$data;
      file_put_contents('./src/doc/highscores.txt', implode(PHP_EOL, $records));
      break;
    }
  }
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/p5.min.js" integrity="sha512-b/htz6gIyFi3dwSoZ0Uv3cuv3Ony7EeKkacgrcVg8CMzu90n777qveu0PBcbZUA7TzyENGtU+qZRuFAkfqgyoQ==" crossorigin="anonymous"></script>
<script src="src/js/secret.js"></script>
<main>
    <h2>ERROR 404 - Seite nicht gefunden</h2>
    <img id="error-img" src="./src/img/404.svg" alt="Bild einer traurigen Wolke">
    <script type="text/javascript">
    var records = <?php echo json_encode($records)?>;
    var count = 0;
    var name = "";
    $(document).ready(function(){
      $("#error-img").click(function(){
        count++;
        if(count==10){
          $(".site-branding--logo").off('click');
          activate();
        }
      });
    });
    </script>
    <form method="POST" action="./404" id="hiddenForm">
      <input type="hidden" id="hiddenInput" name="hs" value=""/>
    </form>
</main>


<?php
include('./footer.php');
?>
