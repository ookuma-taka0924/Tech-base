<?php
$word = "ようこそ！Webサイトへ！！";
$fileName = "mission_1-2.txt";
$fp = fopen($fileName,"w");
fwrite($fp,$word);
fclose($fp);
 ?>
