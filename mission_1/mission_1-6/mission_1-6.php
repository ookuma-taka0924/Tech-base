<?php
//misson_1-6-1

$thisYear = 2019;
$hold = 2000;

for($i = 0;$i < 5; $i++){

  echo $hold ."<br>";
  $hold += 4;

}








echo "<hr>";
//misson_1-6-2

$siritori = array();

$siritori[] = "しりとり";
$siritori[] = "りんご";
$siritori[] = "ごりら";
$siritori[] = "らっぱ";
$siritori[] = "ぱんつ";

echo $siritori[2] ."<br>";

echo "<hr>";
//misson_1-6-3
$word = null;
foreach ($siritori as $key => $value) {
  $word = $word.$value;
  echo $word."<br>";
}

echo "<hr>";
?>
