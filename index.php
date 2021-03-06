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
require("dbconnect.php");//dbconnect.phpの取り込み

//page数の制御。$_REQUEST["page"]が存在し、かつ数字だった場合
//$pageに$_REQUEST["page"]を格納。違う場合、1を格納
if(isset($_REQUEST["page"]) && is_numeric($_REQUEST["page"])){
  $page = $_REQUEST["page"];
} else {
  $page = 1;
}

$rows = 3;

$start = $rows * ($page - 1);

//paginationの設定を行うため、LIMIT ?,5とし、?番目から5つデータを取得する形式に変更している。
$memos = $db->prepare("SELECT * FROM memos ORDER BY id DESC LIMIT ?, ?");
//?に入力する値は数字指定のため、executeに入力するのは得策ではない。
//今回は、bindParam()メソッドを使う。
$memos->bindParam(1, $start ,PDO::PARAM_INT);
$memos->bindParam(2, $rows ,PDO::PARAM_INT);
$memos->execute();

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


?>

<article>
  <?php while($memo = $memos->fetch()):?>
    <p>
      <a href="memo.php?id=<?php print($memo["id"]);?>">
        <?php print(mb_substr(htmlspecialchars($memo["memo"] , ENT_QUOTES),0,50));?>
      </a>
    </p>
    <time>
      <?php print($memo["created_at"]);?>
    </time>
    <hr>
  <?php endwhile;?>

  <?php if($page >=2):?>
  <a href="index.php?page=<?php print($page-1) ;?>">
    <?php print($page -1);?>ページ目へ
  </a>
  <?php endif ;?>
  |
  <?php 
    $counts = $db->query("SELECT COUNT(*) as cnt FROM memos");
    $count = $counts->fetch();
    $max_page = ceil($count["cnt"] / $rows);
    if($page < $max_page):?>
  <a href="index.php?page=<?php print($page+1) ;?>">
    <?php print($page +1);?>ページ目へ
  </a>
  <?php endif ;?>
</article>
<p>
      <a href="input.html">
        メモを追加する
      </a>
</p>
</main>
</body>    
</html>