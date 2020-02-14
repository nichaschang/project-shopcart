<?php
session_start();

require_once("./db.inc.php");

$sql = "DELETE FROM`shopcart` WHERE `pId`=? AND `csId`=?";
$csId = $_SESSION['csId'];
$arrParam = [
    $_GET['deleteId'],
    $csId
];

$stmt = $pdo->prepare($sql);

$stmt->execute($arrParam);

if( $stmt->rowCount() > 0 ){
    header( "Refresh: 2; url=./index2.php");
    echo "刪除成功!!";
    exit();
} else {
    header("Refresh: 2; url=./index2.php");
    echo "Failed";
    exit();
}
?>