<?php

$dsn = 'mysql:dbname=co_***_it_3919_com;host=localhost;charset=utf8;';
$user = 'co-***.it.3919.c';
$password = 'PASSWORD';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//4-2命令を作成
$sql = "CREATE TABLE IF NOT EXISTS tbtest"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT"
	.");";
 //命令を実行
$stmt = $pdo->query($sql);

//4-3命令を作成
$sql ='SHOW TABLES';
//命令を実行
$result = $pdo -> query($sql);
//取得した$resultを表示
foreach ($result as $row){
  echo $row[0];
  echo '<br>';
}
echo "<hr>";

//4-4命令作成
$sql ='SHOW CREATE TABLE tbtest';
  //命令を実行・表示
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[1];
	}
	echo "<hr>";

//4-5 ユーザー入力をできるようにする
$sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
  //データの入力
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$name = '大熊';
	$comment = 'こんにちは！'; //好きな名前、好きな言葉は自分で決めること
  //データをテーブルに確定させる
	$sql -> execute();

  //テーブルを選ぶ命令文を作成
  $sql = 'SELECT * FROM tbtest';
    //命令を実行
  	$stmt = $pdo->query($sql);
    //表を配列の形にする
  	$results = $stmt->fetchAll();

  	foreach ($results as $row){
  		//$rowの中にはテーブルの項目(カラム名)が入る
  		echo $row['id'].',';
  		echo $row['name'].',';
  		echo $row['comment'].'<br>';
  	echo "<hr>";
  	}

    $id = 1; //変更する投稿番号
    	$name = "くまちゃん";
    	$comment = "編集しました。"; //変更したい名前、変更したいコメントは自分で決めること
      //命令を用意
    	$sql = 'update tbtest set name=:name,comment=:comment where id=:id';
      //データの編集文を作成
      $stmt = $pdo->prepare($sql);
      //値を新しく入れていく
    	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
    	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
      //データをテーブルに確定させる
    	$stmt->execute();

      //テーブルを選ぶ命令文を作成
      $sql = 'SELECT * FROM tbtest';
        //命令を実行
      	$stmt = $pdo->query($sql);
        //表を配列の形にする
      	$results = $stmt->fetchAll();

      	foreach ($results as $row){
      		//$rowの中にはテーブルの項目(カラム名)が入る
      		echo $row['id'].',';
      		echo $row['name'].',';
      		echo $row['comment'].'<br>';
      	echo "<hr>";
      	}

      //番号を指定
     	$id = 2;
      //命令を作成
     	$sql = 'delete from tbtest where id=:id';
      //実行
     	$stmt = $pdo->prepare($sql);
      //データを特定
     	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
      //確定させる
     	$stmt->execute();

 ?>
