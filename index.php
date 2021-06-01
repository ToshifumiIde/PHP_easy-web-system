<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title>PHP</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>    
</header>

<main>
<h2>Practice</h2>
<pre>
<?php
//例外処理。エラーが発生した際に、そのまま処理を終了させるのではなく、例外を発生させてその処理を安全に終了させる。接続がうまくいかなかった場合、例外という処理を発生させるのがtry{}catch(){}の例外処理。
try{
  //PDO(PHP Data Objectの略)のオブジェクトのインスタンスを生成
  $db = new PDO(
    //接続文字列
    "mysql:dbname=mydb;host=localhost;charset=utf8;",//host=localhostに修正
    //ユーザー名
    "root",
    //pass
    "root"
  );
}catch(PDOexception $e){
  echo "DB接続エラー" . $e->getMessage();
}
?>
</pre>
</main>
</body>    
</html>