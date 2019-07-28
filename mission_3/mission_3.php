<?php
$number_file = "number.txt";
$fileName = "mission_3.txt";
$delete_file = "delete.txt";



if( !empty($_POST["delete_num"]) ) {
  //echo "削除";
  if(isset($_POST["in_pass"]) ){
    $in_pass = $_POST["in_pass"];
  }else{$in_pass = " ";}
  //var_dump($in_pass);
  $delete_num = $_POST["delete_num"];

  $array = file($fileName,FILE_IGNORE_NEW_LINES);
  foreach ($array as $key => $value) {
    $element = explode(">>",$value);
    if($element[0] == $delete_num){ $pass = $element[4];}
  }
  if($pass == $in_pass){
    $fp = fopen($delete_file,"a") ; fwrite($fp,$delete_num.PHP_EOL) ; fclose($fp) ;
  }else{echo "パスワードが違います。"; }

}elseif( !empty($_POST["userName"]) && !empty($_POST["comment"]) && !empty($_POST["edit_number"]) ) {
  //echo "編集フォーム";
  $name = $_POST["userName"];
  if( isset($_POST["edit_pass"]) ){
    $in_pass = $_POST["edit_pass"];
  }else{$in_pass=" ";}
        //echo "in_passは".$in_pass;
  $comment = $_POST["comment"];
  $num = $_POST["edit_number"];
  $date = date("Y/m/d G:i:s");
  $array = file($fileName,FILE_IGNORE_NEW_LINES);

  //編集パスワード判断
  foreach ($array as $key => $value) {
    $element = explode(">>",$value);
    if($num == $element[0]){ $pass = $element[4];} //echo "passは".$pass;}
  }

  if(is_readable($fileName)){
    $fp = fopen($fileName,"w");
    if($pass == $in_pass){
      foreach ($array as $key => $value) {
        $element = explode(">>",$value);
          if($element[0]==$num){
            $display = $num.">>".$name.">>".$comment.">>".$date.">>".$element[4];
            fwrite($fp,$display.PHP_EOL);
            //echo $display."編集成功";
          }else{
            fwrite($fp,$value.PHP_EOL);
            //echo $value."書き込み成功";
          }
      }
    }else{
      echo "パスワードが違います。";
      foreach ($array as $key => $value) {
        fwrite($fp,$value.PHP_EOL);
        //echo $value."編集なし書き込み成功";
      }
    }
    fclose($fp);
  }
}elseif( !empty($_POST["edit_num"]) ){
  //echo "edit成功";
  if(isset($_POST["edit_num"])){
    $edit_num = $_POST["edit_num"];
    $array = file($fileName,FILE_IGNORE_NEW_LINES);
    foreach ($array as $key => $value) {
      $element = explode(">>",$value);
      if($element[0]==$edit_num){
        $editName = $element[1];
        $editComment = $element[2];
      }
    }
  }
}elseif(!empty($_POST["userName"]) && !empty($_POST["comment"]) ) {
  //echo "通常";
  $name = $_POST["userName"];
  $comment = $_POST["comment"];
  $password = $_POST["password"];
  $num = 0;
  if(is_readable($number_file)){
    $array = file($number_file,FILE_IGNORE_NEW_LINES);
    $num = $array[count($array)-1];
  }
  $num ++;
  $date = date("Y/m/d G:i:s");
  $display = $num.">>".$name.">>".$comment.">>".$date.">>".$password;
  $fp = fopen($fileName,"a") ; fwrite($fp,$display.PHP_EOL) ; fclose($fp) ;
  $fp = fopen($number_file,"a") ; fwrite($fp,$num.PHP_EOL) ; fclose($fp) ;

}

?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>くまちゃん掲示板</title>
  </head>
  <body>

    <h1>夏休みの予定はなーに？</h1>

    <form method="POST">
      <?php
      if(isset($editName) && isset($editComment)){
        echo '<input type="hidden" name="edit_number" value='.$edit_num.'>';
        echo '<p>名前：<input type="text" name="userName" value='.$editName.'></p>';
        echo '<p>コメント：<input type="text" name="comment" value='.$editComment.'> <p>';
        echo '<p>in_pass：<input type="text" name="edit_pass" > <input type="submit" value="編集する" name="send"></p>';
      }else{
        echo '<p>名前：<input type="text" name="userName">  password：<input type="text" name="password"></p>';
        echo '<p>コメント：<input type="text" name="comment">  <input type="submit" value="送信する" name="send"></p>';
      }
        ?>
      <p>（※編集番号：<input type="number" name="edit_num" style="width:60px;">  <input type="submit" value="編集" name="edit">  ※削除依頼：<input type="number" name="delete_num" style="width:60px;">  in_pass:<input type="text" name="in_pass">  <input type="submit" name="delete" value="削除">）</p>
    </form>
      <?php
        if(is_readable($fileName)){
          $array = file($fileName);
          $delete = file($delete_file,FILE_IGNORE_NEW_LINES);
          foreach ($array as $key => $value) {
            $element = explode(">>",$value);
            $choice = 0;
            foreach ($delete as $delete_number) {
              if($element[0] == $delete_number){$choice=1;}
            }
            if($choice!==1){
            echo $element[0]."：".$element[1]." (".$element[3].")"."<br>".">>>".$element[2]."<br>"."<br>";
            }
          }
        }
      ?>

  </body>
</html>
