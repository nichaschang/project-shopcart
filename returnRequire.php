<?php
require_once("db.inc.php");
exit();
// 更新訂單狀態 退貨成功 
$sql_returnAllow="UPDATE `orderlist` SET `outStatus`='退貨成功' WHERE `orderId`=?";
$arr__returnAllow=[
    $_POST["orderId"]
];
$stmt=$pdo->prepare($sql_returnAllow);
$stmt->execute($arr__returnAllow);

//更新退貨 orderlist & orderdetail
$sql_returnAgree="UPDATE `returnlist` SET `returnStatus`='同意退貨' WHERE `returnlistId`=? ";
$arr_returnAgree=[
    $_POST["returnlistId"]
];
$stmt=$pdo->prepare($sql_returnAgree);
$stmt->execute($arr_returnAgree);

$sql_orderAgree=""
?>