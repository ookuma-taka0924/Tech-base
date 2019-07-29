<html>
<html lang="ja">
<head>
  <meta name="viewport" content="width=320, height=480, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes">
	<title>Kuma' Profile</title>
  <link rel="stylesheet" href="css/stylesheet.css">
  <link href="https://fonts.googleapis.com/css?family=Just+Another+Hand&display=swap" rel="stylesheet">
</head>

<body>
<div class="top">
</div>

<h1 id="midashi_1" class="title"> Kuma's Profile </h1>

<div class="index-color">
<ul class="index">
  <li><a href="#comment1011">自己紹介</a> ／</li>
  <li><a href="#join1012">所属・趣味など</a> ／</li>
  <li><a href="#other1013">その他</a> ／</li>
  <li><a href="#form1014">掲示板</a></li>
</ul>
</div>

<div class="float-clear">
    <div class="float-box">
      <img class="picture" src="image/plofile1.jpg" alt="自分を象徴する写真など" title="プロフィール画像" width="320px" >
    </div>
</div>
（画像についてひとこと：てっぺんまで登りつめる！！)<br>

<hr>
<div class="comment">
<p class="line" id="comment1011">***です！！</p>
<p>5月からプログラミングを始めました！IT志望です。</p>
</div>
<hr>

<h2 id="join1012">所属など</h2>
<p>**大学**学部に所属しています。サークルは無所属。<br>
大学2年から塾講師やってます！<br></p>


<h2>趣味</h2>
<p>ボルダリング / ダーツ / カクテル作り / コンセプトカフェ巡り / 筋トレ / TRPG / ボードゲーム / キックボクシング etc...<br>
<span class="interested">関心→リアル脱出ゲーム / オイルモーション / キャンプ / スカイダイビング / 猫カフェ / 国内旅行 / ポーカー / 写真コンテスト / ジグソーパズル / 猿島 / 釣り /<br>
基本情報技術者試験 / プログラミング(Java) / Paiza / ITインターン / Eve(歌手) / maimai / バイク免許 / アルゴリズム / プラネタリウム　/ 車中泊 etc...<br></span>
 <br>
<span class="normal">※全体的に広ーく浅ーくです。ただ、楽しさは知っています！共通点があればぜひ話題にして、話しかけてください！<br>
　 共通点がなくても好奇心があふれているので、好きなことを話題にしてください！食い付きます！！<br></span>
<br>
<strong>！！趣味・関心を話せる友達、大募集！！</strong></p>

<h2>自分的ランキング★トップ３</h2>
<strong> 私の最近の関心事トップ３です！</strong><br>

<ol>
	<li> ITインターン</li>
	<li> 基本情報技術者試験</li>
	<li> リアル脱出ゲーム</li>
</ol>

<hr>

<h2 id="other1013">その他</h2>
<h3>使用PC</h3>
 Windows

<h3>PC利用経験や、普段の使い方</h3>
<p>レポートやプレゼンを作る際に使っています。<br>
５月からは、ProgateやPaizaという学習サイトなどでプログラミングを勉強しています。<br>
テキストエディタはAtomで、Javaをメインに据えてます。<br>
かるーいゲームっぽいのは作れるようになりました！<br></p>

<h3>自分の強みや弱みなど</h3>
<p>強み：<br></p>
<ul>
  <li>真面目が売り！！</li>
  <li>計画したり必要な事把握したり、マネージャー的な事は得意です！</li>
  <li>勉強することは好きです。何でも勉強だと思って取り組みます！</li>
</ul>
<p>弱み；<br></p>
<ul>
  <li>一生懸命すぎて余裕がない感じも…</li>
  <li>真面目が祟って面白みがない！！</li>
  <li>距離感の詰め方がバグってます</li>
</ul>

<div class="go">
<h3>***の参加にあたり、意気込み</h3>
<p>やる気は十分！MVP狙ってきます！<br>
気軽に声をかけてくれたら嬉しいです！ <br>
一緒に悩ませてください！！<br></p>
</div>

<div class="index-color">
<ul class="index">
  <li><a href="#midashi_1"> このページのTOPへ </a>  ／</li>
  <li><a href="https://www.google.co.jp/" target="_blank"> ググる </a></li>
</ul>
</div>

<div class="bottom" id="form1014">

  <?php
  $number_file = "number.txt";
  $fileName = "mission_3.txt";
  $delete_file = "delete.txt";

  if(isset($_POST["send"])){
  if(isset($_POST["userName"]) && isset($_POST["comment"])){
  $name = $_POST["userName"];
  $comment = $_POST["comment"];
  $num = 0;
  if(is_readable($number_file)){
    $array = file($number_file,FILE_IGNORE_NEW_LINES);
    $num = $array[count($array)-1];
  }
  $num ++;
  $date = date("Y/m/d G:i:s");
  $display = $num.">>".$name.">>".$comment.">>".$date;
  $fp = fopen($fileName,"a") ; fwrite($fp,$display.PHP_EOL) ; fclose($fp) ;
  $fp = fopen($number_file,"a") ; fwrite($fp,$num.PHP_EOL) ; fclose($fp) ;
  }
  }elseif (isset($_POST["delete"])) {
    $delete_num = $_POST["delete_num"];
    $fp = fopen($delete_file,"a") ; fwrite($fp,$delete_num.PHP_EOL) ; fclose($fp) ;
  }

  ?>
      <form method="POST">
        <p>名前：<input type="text" name="userName"></p>
        <p>コメント：<input type="text" name="comment">  <input type="submit" value="送信" name="send"></p>
      </form>
      <form method="POST">
        <p>※削除依頼：<input type="number" name="delete_num" >  <input type="submit" value="削除" name="delete" ></p>
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
</div>
</body>
</html>
