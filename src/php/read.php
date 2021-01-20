<?php

function readFromCSV($fName, $dataHandler){
  $row = 1;
  if (($handle = fopen("/src/csv/"$fName, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000)) !== FALSE) {// TODO: adjust len?
        $num = count($data);
        $dataHandler($num, $data);
        /*echo "<p> $num fields in line $row: <br /></p>\n";
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }*/
        $row++;
    }
    fclose($handle);
  }
}

?>
