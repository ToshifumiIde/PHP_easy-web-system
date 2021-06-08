<?php

//例外処理。
//エラーが発生した際に、そのまま処理を終了させるのではなく、例外を発生させてその処理を安全に終了させる。
//接続がうまくいかなかった場合、例外という処理を発生させるのがtry{}catch(){}の例外処理。
try {
  //PDO(PHP Data Objectの略)のオブジェクトのインスタンスを生成
  $db = new PDO(
    //接続文字列
    "mysql:dbname=mydb;host=localhost;charset=utf8",
    //ユーザー名
    "root",
    //pass
    "root",
  );
} catch(PDOException $e) {
  echo "DB接続エラーです。エラー内容は" . $e->getMessage();
}