<?php
session_start();
require_once('funcs.php');

session_security();
$pdo = db_conn();

$id = $_GET['id'];

$stmt = $pdo->prepare('DELETE FROM gs_user_table WHERE id = :id;');

$stmt->bindValue(':id', $id, PDO::PARAM_INT);  

$status = $stmt->execute();

if($status === false){
  sql_error($stmt);
}else{
  redirect ('login_select.php');
}

?>