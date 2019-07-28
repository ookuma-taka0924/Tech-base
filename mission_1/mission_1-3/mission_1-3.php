<?php
$fileName = "mission_1-2.txt";
$fp = fopen($fileName,"r");
$word = fgets($fp);
echo $word;
fclose($fp);
 ?>
