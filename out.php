<?php
session_start();
require_once("./db.inc.php");

error_reporting(0);
$csId=$_SESSION['csId'];
// 選擇付款方式
    if($_POST['paymentType']==null){
        echo '請選擇付款方式';
        exit();
    }else{
        echo '結帳完成';
    };

// 先更新購物車數量
 $sql_updateCount="UPDATE `shopcart` SET `count`=? WHERE `csId`=? AND `pId`=?";
 $stmt=$pdo->prepare($sql_updateCount);
for($i=0;$i<count($_POST['pId']);$i++){
    $arr_updateCount=[  
        $_POST['count'][$i],
        $csId,
        $_POST['pId'][$i]
    ];
    $stmt->execute($arr_updateCount);
 };

// 透過 DpId 將產品數量為0的產品刪除
$sql_updateCountD="DELETE FROM `shopcart` WHERE `csId`=? AND `pId`=?";
$stmt=$pdo->prepare($sql_updateCountD);

for($i=0;$i<count($_POST['DpId']);$i++){
    $arr_updateCountD=[
        $csId,
        $_POST['DpId'][$i]
    ];
    $stmt->execute($arr_updateCountD);
}         

//產生訂單
$sql_order="INSERT INTO `orderlist`(`csId`,`total`,`paymentType`,`shippingWay`,`outStatus`) VALUES (?,?,?,?,'訂單成立')";

$arr_order=[
    $csId,
    $_POST['total'],
    $_POST['paymentType'],
    $_POST['shippingWay']
];
$stmt=$pdo->prepare($sql_order);
$stmt->execute($arr_order);
$orderId = $pdo->lastInsertId();

//將 `shopcart`與`orderlist`的資料傳給`orderdetail`
$sql_insertCount="INSERT INTO `orderdetail` (`orderId`,`pId`,`count`) VALUES (?,?,?)";
$stmt=$pdo->prepare($sql_insertCount);
for($i=0;$i<count($_POST['pId']);$i++){
    $arr1_insertCount=[
        $orderId,
        $_POST['pId'][$i],
        $_POST['count'][$i]
    ];
    $stmt->execute($arr1_insertCount);
}


//結帳後清除購物車內容
$sql_cleanShopcart="DELETE FROM `shopcart` WHERE `csId`=?";
$arr_cleanShopcart=[
    $csId
];
$stmt=$pdo->prepare($sql_cleanShopcart);
$stmt->execute($arr_cleanShopcart);
header("Refresh:0;url=./index2.php");

?>