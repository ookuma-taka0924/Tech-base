<?php
$word = "ようこそ！Webサイトへ！！";
$fileName = "mission_1-2.txt";
$fp = fopen($fileName,"a");
fwrite($fp,$word);
fclose($fp);
 ?>
