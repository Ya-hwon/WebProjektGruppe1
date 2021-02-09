<?php

function readFromCSV($fName, $dataHandler){
  $row = 1;
  if (($handle = fopen("src/csv/".$fName, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000)) !== FALSE) {// TODO: adjust len?
        $num = count($data);
        $dataHandler($num, $row, $data);
        $row++;
    }
    fclose($handle);
  }
}

?>
