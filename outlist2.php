<?php
require_once("./db.inc.php");

$sql_updateOut="UPDATE `orderlist` SET `outStatus`='已出貨' WHERE `orderId`=?";
$arr_updateOut=[
    $_POST['orderId']
];
$stmt=$pdo->prepare($sql_updateOut);
$stmt->execute($arr_updateOut);

?>