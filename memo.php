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
<?php
//例外処理。エラーが発生した際に、そのまま処理を終了させるのではなく、例外を発生させてその処理を安全に終了させる。接続がうまくいかなかった場合、例外という処理を発生させるのがtry{}catch(){}の例外処理。
try{
  //PDO(PHP Data Objectの略)のオブジェクトのインスタンスを生成
  $db = new PDO(
    //接続文字列
    "mysql:dbname=mydb;host=localhost;charset=utf8;",
    //host=localhostに修正
    //ユーザー名
    "root",
    //pass
    "root"
  );
}catch(PDOException $e){
  echo "DB接続エラー" . $e->getMessage();
}
//dbにデータを格納していく。->exec()メソッドを使うと()内のsqlを発行できる。
//exec()メソッドの戻り値は「実際にdbのtableに影響を与えた行の数」が帰ってくるため、$countで受け取る。
// $count = $db->exec('INSERT INTO my_items SET maker_id=1, item_name="もも", price=210, keyword="缶詰,ピンク,甘い"');
//echoで実行結果の件数を取得
// echo $count . "件のデータを挿入しました";

//dbのquery()メソッドを使用。query()メソッドもパラメータにsqlを取るがquery()メソッドは戻り値にquery()メソッド内で実行したsql文で「得られた値」を返す。
// $records = $db->query("SELECT * FROM my_items");
//$recordsには「得られた値が格納される」
//$records->fetch()のfetch()（割り当てる）メソッドは、dbから受け取ったレコードの行の集まりのうち、1行を取り出すメソッド。得られた値にfetch()メソッドを用いることで、Arrayが返却される。$recordに格納された値は連想配列となっており、["item_name"]などでdbのカラム名から取り出しが可能。
// while($record = $records->fetch()){
//   print($record["item_name"]) . "\n";
// }


//idをユーザーの指定するidとするためprepare()メソッドを使用する。
//id=?とし、execute(array())メソッドで格納してく。

$id = $_REQUEST["id"];

if(!is_numeric($id) || $id<= 0){
  print("1以上の数字を入力してください");
  exit();
}

$memos = $db->prepare("SELECT * FROM memos WHERE id=?");
$memos->execute(array(
  $id,
));
$memo = $memos->fetch();
?>

<article>
  <pre>
    <?php print(htmlspecialchars($memo["memo"] , ENT_QUOTES)) ;?>
  </pre>
  <a href="index.php">戻る</a>
</article>

</main>
</body>    
</html>