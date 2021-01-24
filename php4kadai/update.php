<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更
require_once('funcs.php');

//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["lid"];
$sns = $_POST["sns"];
$strengths  = $_POST["strengths"]; //追加されています
$weakness   = $_POST["weakness"]; //追加されています
$id    = $_POST["id"];

//2. DB接続します
//*** function化する！  *****************
$pdo = db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE 
                            gs_bm_table 
                            SET 
                            name = :name, 
                            lid=:lid,
                            lpw=:lpw,
                            sns= :sns,
                            strengths = :strengths,
                            weakness = :weakness,
                            indate = sysdate()
                        WHERE
                            id=:id;
                            ");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sns', $sns, PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':strengths', $strengths, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':weakness', $weakness, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect('view.php');
}
?>
