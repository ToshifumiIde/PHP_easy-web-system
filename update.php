<?php 
//db接続を実行
require("dbconnect.php");

//$_REQUEST["id"]が存在し、かつ中身が数字だった場合のみ、編集を可能とする
if(isset($_REQUEST["id"]) && is_numeric($_REQUEST["id"])){
  //編集するidを定義する。
  //$_REQUEST["id]とすることで、~/update.php?id=1とした時の
  //id=1の部分を取得でき、該当するidの編集ができる様になる。
  $id = $_REQUEST["id"];
  
  //dbから今回updateするqueryを取得する
  $memos = $db->prepare("SELECT * FROM memos WHERE id =?");
  $memos->execute(array(
    $id,
  ));
  $memo = $memos->fetch();
}
;?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
  </head>
  <body>
    <header>
      <h1 class="font-weight-nomal">PHP</h1>
    </header>
    <main>
      <h2>Practice</h2>
      <form action="update_do.php" method="post">
        <input type="hidden" name="id" value="<?php print($id) ;?>">
        <textarea
          name="memo"
          cols="50"
          rows="10"
        ><?php print($memo["memo"]) ;?></textarea>
        <br />
        <button type="submit">登録する</button>
      </form>
    </main>
  </body>
</html>
