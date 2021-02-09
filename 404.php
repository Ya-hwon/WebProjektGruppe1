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

<main>
    <h2>Seite nicht gefunden - filler</h2>
    <script type="text/javascript">
    var records = <?php echo json_encode($records)?>;
    var count = 0;
    var name = "";
    $(document).ready(function(){
      $(".site-branding--logo").click(function(){
        count++;
        if(count==10){
          $(".site-branding--logo").off('click');
          activate();
        }
      });
    });
    </script>
    <script src="src/js/secret.js"></script>
    <form method="POST" action="./404" id="hiddenForm">
      <input type="hidden" id="hiddenInput" name="hs" value=""/>
    </form>
</main>


<?php
include('./footer.php');
?>
