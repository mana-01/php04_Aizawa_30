
<?php
require_once('funcs.php');
$pdo = db_conn();

session_start();
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

$sql = "SELECT * From gs_user_table where lid=:lid AND lpw=:lpw";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status === false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();

//if(password_verify($lpw, $val['lpw'])){ //* PasswordがHash化の場合はこっちのIFを使う
if( $val['lid'] != ""){
    $_SESSION["chk_ssid"] = session_id();
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["name"] = $val['name'];

    header('Location: select.php');
}else{
    //Login失敗時(Logout経由)
    header('Location:login.php');
}

exit();





?>