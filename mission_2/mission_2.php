<?php
$fileName = "mission_2.txt";
if(isset($_POST["comment"])){
$word = $_POST['comment'];
if (!empty($word)) {
if(strpos($word,'完成') !== false){$word = $word." << おめでとう！！！";}
elseif (strpos($word,'頑張る') !== false) {$word = $word." << 応援してる！";}
elseif (strpos($word,"こんにちは") !== false) {$word = $word." << こんにちは！";}
elseif (strpos($word,"おめでとう！"!==false)) {$word = $word." << ありがとう！これからも頑張る！！" ;}
$word = $word."<br>".PHP_EOL;
$fp = fopen($fileName,"a");
fwrite($fp,$word);
fclose($fp);
}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>送信フォーム</title>
  </head>
  <body>
    <form  method="post" >
      <input type="text" name="comment"><br>
      <input type="submit" value="送信"><br>
      <?php if(is_readable($fileName)){
        $array = file($fileName);
        if(isset($array[0])){
          foreach ($array as $key => $value) {
            echo $value;
          }
        }
      }?><br>
    </form>
  </body>
</html>
