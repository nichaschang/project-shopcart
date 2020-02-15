<?php
require_once("./db.inc.php");
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

//廠商端 訂單成立

$sql_updateOut="UPDATE `orderlist` SET `outStatus`='已出貨' WHERE `orderId`=?";
$arr_updateOut=[
    $_POST['orderId']
];
$stmt=$pdo->prepare($sql_updateOut);
$stmt->execute($arr_updateOut);


$sql_updateOutDetail="UPDATE `orderdetail` SET `outStatus`='已出貨' WHERE `orderId`=?";
$arr_updateOutDetail=[
    $_POST['orderId']
];
$stmt=$pdo->prepare($sql_updateOutDetail);
$stmt->execute($arr_updateOutDetail);

?>