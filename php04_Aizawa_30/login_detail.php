<?php
session_start();
require_once('funcs.php');
session_security();
$id = $_GET['id'];
$pdo = db_conn();

$stmt = $pdo->prepare('SELECT * FROM gs_user_table where id = :id;');
$status = $stmt->execute();
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

$view="";
if ($status === false) {
  sql_error($stmt);
    //execute（SQL実行時にエラーがある場合）
}else{
    $view = $stmt->fetch();
};

?>


<html>

<!-- input part -->

<head>
    <meta charset="utf-8">
    <title>管理者情報</title>
</head>

<body>
    <form action="login_update.php" method="post">
        名前: <input type="text" name="name" value="<?= $view['name']?>">
        ログインID: <input type="text" name="lid" value="<?= $view['lid']?>">
        ログインパスワード: <input type="text" name="lpw" value="<?= $view['ldw']?>">
        管理者権限レベル: <input type="text" name="kanri_flg" value="<?= $view['kanri_flg']?>">
        <input type="hidden" name="id" value="<?= $view['id']?>">
        <input type="submit" value="変更">
    </form>
</body>

</html>
