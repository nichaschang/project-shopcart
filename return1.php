<?php
require_once("./db.inc.php");

//退貨單資料插入

$sql_returnlist="INSERT INTO `returnlist`(`orderId`,`returnStatus`,`returnPay`,`buyerName`,`buyerPhone`,`buyerAdress`,`returnReason`) VALUES (?,'退貨處理中',?,?,?,?,?)";
$arr_returnlist=[
    $_POST['orderId'],
    $_POST['returnPay'],
    $_POST['buyerName'],
    $_POST['buyerPhone'],
    $_POST['buyerAdress'],
    $_POST['returnMsg']
];
$stmt=$pdo->prepare($sql_returnlist);
$stmt->execute($arr_returnlist);
$returnId = $pdo->lastInsertId();

$sql_returndetail="INSERT INTO `returndetail` (`returnId`,`pId`,`count`) VALUES (?,?,?)";

$stmt=$pdo->prepare($sql_returndetail);
for($i=0;$i<count($_POST['pIdarr']);$i++){
    $arr_returndetail=[
        $returnId,
        $_POST['pIdarr'][$i],
        $_POST['countarr'][$i]
    ];
    $stmt->execute($arr_returndetail);
};

//將原訂單的狀態做更改
$sql_updateStatus="UPDATE `orderdetail` SET `outStatus`='退貨處理中' WHERE `orderId`=? AND `pId`=?";
$stmt=$pdo->prepare($sql_updateStatus);
for($i=0;$i<count($_POST['pIdarr']);$i++){
$arr_updateStatus=[
    $_POST['orderId'],
    $_POST['pIdarr'][$i]
];
$stmt->execute($arr_updateStatus);
};

?>