!<!doctype html>
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
    try {
      $db = new PDO(
        "mysql:dbname=mydb;host=localhost;charset=utf8",
        "root",
        "root"
      );
      //$db->prepare()メソッドは文字通り「事前準備する」メソッド。SQLを持たす。ユーザーからの入力情報を「?」で受け取る準備を行う。
      //返り値はオブジェクトとなる。
      $statement = $db->prepare('INSERT INTO memos SET memo=? , created_at=NOW()');
      //オブジェクトに対し、execute()メソッドを使用する（exec()メソッドでは無い点に注意）
      //execute()メソッドのパラメータには、実際に何が入るかを配列で指定する。
      //prepare()で作った「?」の部分に、今指定した部分が入る。
      $statement->bindParam(1,$_POST["memo"]);
      $statement->execute(
        // array($_POST["memo"])//bindParam()で何番目に何を入れるか指定した場合、execute()メソッド内で値を配列で格納する必要は無い。
    );
      //ユーザーから送信された値を受け取る場合は、prepare()メソッドを使用したオブジェクトにexecute()メソッドを用いて安全性を高めた方が良い。
      echo "メッセージが登録されました";
    } catch(PDOException $e) {
      echo "DB接続エラー：". $e->getMessage();
    }
;?>

</pre>
</main>
</body>    
</html>