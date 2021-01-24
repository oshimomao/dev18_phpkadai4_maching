<?php

/**
 * １．PHP
 * [ここでやりたいこと]
 * まず、クエリパラメータの確認 = GETで取得している内容を確認する
 * イメージは、select.phpで取得しているデータを一つだけ取得できるようにする。
 * →select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * ※SQLとデータ取得の箇所を修正します。
 */
//1.DB接続する（DBのテーブル名が合っているかを必ず確認）
// try {
//     $db_name = "gs_db3";    //データベース名
//     $db_id   = "root";      //アカウント名
//     $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
//     $db_host = "localhost"; //DBホスト
//     $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
// } catch (PDOException $e) {
//     exit('DB Connection Error:'.$e->getMessage());
// }

// funcs.phpで関数化したものを持ってくる
// funcs.phpのフォルダで作成した関数を使いたい！という指示を出す
// require_once('funcs.php');
// $pdo = db_conn();
// $id = $_GET['id'];

// //２．データ登録SQL作成
// $stmt = $pdo->prepare('SELECT * FROM gs_an_table WHERE id = ' .$id .';');
// $status = $stmt->execute();


// //３．データ表示
// $view = "";
// if ($status == false) {

//     sql_error($status);
// } else {
//     $row = $stmt->fetch();
// }


// ?>

<?php
/**
 * １．PHP
 * [ここでやりたいこと]
 * まず、クエリパラメータの確認 = GETで取得している内容を確認する
 * イメージは、select.phpで取得しているデータを一つだけ取得できるようにする。
 * →select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * ※SQLとデータ取得の箇所を修正します。
 */
// var_dump($_GET);

require_once('funcs.php');
$pdo = db_conn();
$id = $_GET['id'];
//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = ' . $id . ';');
$status = $stmt->execute();
//３．データ表示

if ($status == false) {
    sql_error($status);
} else {
    $row = $stmt->fetch();
}
?>


<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="view.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>詳細データ</legend>
     <label>名前：<input type="text" name="name" value="<?= $row['name']?>"></label><br>
     <label>ID：<input type="text" name="lid" value="<?= $row['lid']?>"></label><br>
     <label>PW：<input type="text" name="lpw" value="<?= $row['lpw']?>"></label><br>
     <label>sns：<input type="text" name="sns" value="<?= $row['sns']?>"></label><br>
     <label>強み：<input type="text" name="strengths" value="<?= $row['strengths']?>"></label><br>
     <label>弱み：<input type="text" name="weakness" value="<?= $row['weakness']?>"></label><br>
     <input type="hidden" name="id" value=<?= $row['id'] ?>>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>