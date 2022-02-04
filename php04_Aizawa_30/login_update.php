<?php
$name = $_POST['name'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];

session_start();
require_once('funcs.php');

session_security();
$pdo = db_conn();

$stmt = $pdo->prepare('UPDATE gs_user_table
SET
name= :name,
lid= :lid,
lpw= :lpw,
kanri_flg= :kanri_flg
WHERE id = :id;');

$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

echo $name, $lid, $lpw, $kanri_flg;
echo $stmt;

$status = $stmt->execute();

if($status === false){
  sql_error($stmt);
  exit();
}else{
//   redirect ('login_select.php');
};
