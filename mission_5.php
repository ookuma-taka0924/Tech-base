<?php

//DBへの接続
$dsn = 'mysql:dbname=co_***_it_3919_com;host=localhost;charset=utf8;';
$user = 'co-***.it.3919.c';
$password = 'PASSWORD';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


//Tableの作成::Table名＝board
$sql = "CREATE TABLE IF NOT EXISTS keiziban(
id INT AUTO_INCREMENT PRIMARY KEY,
name varchar(32),
comment TEXT,
date_time TEXT,
pass TEXT DEFAULT NULL
);";
$stmt = $pdo->query($sql);

//作ったTable一覧表示
/*
$sql = "SHOW TABLES";
$stmt = $pdo -> query($sql);
foreach ($stmt as $key => $value) {
  echo $value[0];
  echo "<br>";
}
*/

//tableの構成表示
/*
$sql = 'SHOW CREATE TABLE keiziban';
$stmt = $pdo -> query($sql);
foreach ($stmt as $key => $value) {
  echo $value[1];
  echo "<br>";
}
*/

/*//keizibanの内容表示
$sql = "SELECT * FROM keiziban";
//echo $sql;
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll();
//var_dump($result);
foreach ($result as $key => $value) {
  echo $value["id"].">>";
  echo $value["name"].">>";
  echo $value["comment"].">>";
  echo $value["date_time"].">>";
  echo $value["pass"]."<br>";
}
*/

//編集フォーム
if(!empty($_POST["edited_num"]) ) {

  $edit_number = $_POST["edited_num"];
  $edit_name = $_POST["name"];
  $edit_comment = $_POST["comment"];
  $date_time = date("Y/m/d H:i:s");
  $edit_pass = $_POST["edit_pass"];
  $ok_pass = false;

  $sql = "SELECT * FROM keiziban";
  $stmt = $pdo -> query($sql);
  $result = $stmt -> fetchAll();
  foreach ($result as $key => $value) {
    if($edit_number == $value["id"]){
      if(strcmp($value["pass"],$edit_pass) == 0){ $ok_pass = true; }
    }
  }

  if($ok_pass){
    $sql = "UPDATE keiziban SET name=:name,comment=:comment,date_time=:date_time where id=:id";
    $stmt = $pdo -> prepare($sql);
    $update = array(':name'=>$edit_name,':comment'=>$edit_comment,':date_time'=>$date_time,':id'=>$edit_number);
    $stmt -> execute($update);
    //echo "更新しています";
  }elseif(!$ok_pass){echo "パスワードが違います";}
}
//削除フォーム
elseif(!empty($_POST["delete_num"])){
  $delete_num = $_POST["delete_num"];
  $in_pass = $_POST["in_pass"];
  $ok_pass = false;

  $sql = "SELECT * FROM keiziban";
  $stmt = $pdo -> query($sql);
  $result = $stmt -> fetchAll();
  foreach ($result as $key => $value) {
    if($delete_num == $value["id"]){
      if(strcmp($value["pass"],$in_pass) == 0){ $ok_pass = true; }
    }
  }

  if($ok_pass){
    $sql = "delete from keiziban where id=:id";
    $stmt = $pdo -> prepare($sql);
    $stmt -> bindValue(':id',$delete_num,PDO::PARAM_INT);
     $stmt -> execute();
  }elseif(!$ok_pass){echo "パスワードが違います";}

}
//編集番号を適用
elseif (!empty($_POST["edit_num"])) {
  $edit_num = $_POST["edit_num"];
  $sql = "SELECT * FROM keiziban";
  $stmt = $pdo -> query($sql);
  $result = $stmt -> fetchAll();
  foreach ($result as $key => $value) {
    if( $value["id"] == $edit_num ){
      $edit_name = $value["name"];
      $edit_comment = $value["comment"];
    }

  }
}
//通常フォーム
elseif(!empty($_POST["name"]) && !empty($_POST["comment"]) ){

  $name = $_POST["name"];
  $comment = $_POST["comment"];
  $pass = $_POST["pass"];
  $date_time = date("Y/m/d H:i:s");
  //echo $name.$comment.$pass.$date_time;

$sql = "INSERT INTO keiziban (name,comment,date_time,pass) VALUES (:name, :comment, :date_time, :pass)";
$stmt = $pdo -> prepare($sql);

$stmt -> bindValue(':name', $name, PDO::PARAM_STR);
$stmt -> bindValue(':comment',$comment,PDO::PARAM_STR);
$stmt -> bindValue(':date_time',$date_time,PDO::PARAM_STR);
$stmt -> bindValue(':pass',$pass,PDO::PARAM_STR);

$stmt -> execute();

}
/*
$edit_num = $_post["edit_num"];
$delete_num = $_post["delete_num"];
*/

 ?>

 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>くまちゃん掲示板</title>
   </head>
   <body>

     <form  method="post">
     <?php
     if(isset($edit_num)){
       echo '<p>名前：<input type="text" name="name" value='.$edit_name.'>　→in_pass：<input type="text" name="edit_pass"><br>
       コメント： <input type="text" name="comment" style="width:400px;" value='.$edit_comment.'>
      <input type="submit" name="edit" value="編集する"><input type="hidden" name="edited_num" value='.$edit_num.'><br></p>';

    }else{
       echo '<p>名前：<input type="text" name="name">　pass：<input type="text" name="pass"><br>
       コメント： <input type="text" name="comment" style="width:400px;">
      <input type="submit" name="send" value="送信する"><br></p>';
    }
      ?>

       ※編集番号：<input type="number" name="edit_num" style="width:60px;"> <input type="submit" name="edit" value="編集">　※削除依頼：<input type="number" name="delete_num" style="width:60px;"> →in_pass：<input type="text" name="in_pass">  <input type="submit" name="delete" value="削除"></p>
     </form>

   <?php
   //掲示板の表示
     echo "<hr>";
     $sql = "SELECT * FROM keiziban";
     $stmt = $pdo -> query($sql);
     $result = $stmt -> fetchAll();
     foreach ($result as $key => $value) {
       echo $value['id']."：".$value['name']." (".$value['date_time'].")<br>";
       echo $value['comment']."<br><hr>";
     }
    ?>

   </body>
 </html>
