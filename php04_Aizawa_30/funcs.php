<?php
//共通に使う関数を記述
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
};

function db_conn()
{
    try {
        $db_name = 'assignment_db';    //データベース名
        $db_id   = 'root';      //アカウント名
        $db_pw   = 'root';      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = 'localhost'; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}


function sql_error($stmt){
    $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
};


function redirect($file_name){
    header('Location: ' . $file_name);
    exit();
}

function session_security(){
if( !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
    echo "LOGIN ERROR";
    exit();
}else{
  session_regenerate_id(true);
  $_SESSION["chk_ssid"] = session_id();
}
}