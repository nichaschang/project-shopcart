<?php
require_once("./db.inc.php");

// echo "<pre>";
// print_r($_POST['pIdarr'][0]);
// print_r($_POST['pIdarr'][1]);
// echo "</pre>";
// exit();
$sql_returnlist="INSERT INTO `returnlist`(`orderId`,`returnPay`,`csPhone`,`csAdress`,`returnReason`) VALUES (?,?,?,?,?)";
$arr_returnlist=[
    $_POST['orderId'],
    $_POST['reMoney'],
    $_POST['csPhone'],
    $_POST['csAdress'],
    $_POST['returnMsg']
];
$stmt=$pdo->prepare($sql_returnlist);
$stmt->execute($arr_returnlist);
// echo "<pre>";
// print_r($_POST['pIdarr']);
// echo "</pre>";
// exit();
$returnlistId = $pdo->lastInsertId();

$sql_returndetail="INSERT INTO `returndetail` (`returnlistId`,`pId`,`count`) VALUES (?,?,?)";

for($i=0,$k=0;$i<count($_POST['pIdarr']);$i++){
    $arr_returndetail=[
        $returnlistId,
        $_POST['pIdarr'][$i],
        $_POST['countarr'][$i]
    ];
    $stmt=$pdo->prepare($sql_returndetail);
    $stmt->execute($arr_returndetail);
    $k++;
//     echo "<pre>";
// print_r($arr_returndetail);
// echo "</pre>";
// exit();
};

$sql_updateStatus="UPDATE `orderlist` SET `outStatus`='退貨申請中' WHERE `orderId`=?";
$arr_updateStatus=[
    $_POST['orderId']
];
$stmt=$pdo->prepare($sql_updateStatus);
$stmt->execute($arr_updateStatus);

$sql_updateStatus="UPDATE `orderdetail` SET `outStatus`='退貨申請中' WHERE `orderId`=? AND `pId`=?";
$stmt=$pdo->prepare($sql_updateStatus);
for($i=0;$i<count($_POST['pIdarr']);$i++){
$arr_updateStatus=[
    $_POST['orderId'],
    $_POST['pIdarr'][$i]
];
$stmt->execute($arr_updateStatus);
};
?>