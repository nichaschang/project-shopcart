<?php
require_once("db.inc.php");
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

if(isset($_POST['returnId'])){
$sql_check="SELECT * FROM `orderdetail` WHERE `orderId`=?";
$arr_check=[
    $_POST["orderId"]
];
$stmt=$pdo->prepare($sql_check);
$stmt->execute($arr_check);
$arr=$stmt->fetchAll(PDO::FETCH_ASSOC);
$checkAll=0;
for($i=0;$i<count($arr);$i++){
    $box[]=$arr[$i]["outStatus"];
    if($box[$i]!='退貨處理中'){
        $checkAll+=1;
    }else{
        $checkAll=0;
    }
};

// echo "<pre>";
// print_r($checkAll);
// echo "</pre>";
// exit();
// 更新訂單狀態 如果是全產品退貨 則顯示退貨成功  如果是部分退貨，則將訂單狀態
if($checkAll>=1){
    $sql_returnAllow="UPDATE `orderlist` SET `outStatus`='已出貨' WHERE `orderId`=?";
    $arr__returnAllow=[
        $_POST["orderId"]
    ];
    $stmt=$pdo->prepare($sql_returnAllow);
    $stmt->execute($arr__returnAllow);
}else{
    $sql_returnAllow="UPDATE `orderlist` SET `outStatus`='退貨完成' WHERE `orderId`=?";
    $arr__returnAllow=[
        $_POST["orderId"]
    ];
    $stmt=$pdo->prepare($sql_returnAllow);
    $stmt->execute($arr__returnAllow);
}


// 更新orderdetail
$sql_returnDetail="UPDATE `returnlist` SET `returnStatus`='退貨完成' WHERE `returnId`=? ";

$stmt=$pdo->prepare($sql_returnDetail);

$arr_returnDetail=[
    $_POST["returnId"]
];
$stmt->execute($arr_returnDetail);

$sql_Updateorderdetail="UPDATE `orderdetail` SET `outStatus`='退貨完成' WHERE `orderId`=? AND `pId`=?";
$stmt=$pdo->prepare($sql_Updateorderdetail);
for($i=0;$i<count($_POST["pId"]);$i++){
    $arr_Updateorderdetail=[
        $_POST["orderId"],
        $_POST["pId"][$i]
    ];
    $stmt->execute($arr_Updateorderdetail);
};
}else{
    $sql_Updateorderdetail="UPDATE `orderdetail` SET `outStatus`='已出貨' WHERE `orderId`=? AND `pId`=?";
    $stmt=$pdo->prepare($sql_Updateorderdetail);
    for($i=0;$i<count($_POST["pId"]);$i++){
        $arr_Updateorderdetail=[
            $_POST["orderId"],
            $_POST["pId"][$i]
    ];
    $stmt->execute($arr_Updateorderdetail);
};
    $sql_DelreturnId1="DELETE FROM `returnlist` WHERE `returnId`=?";
    $arr_DelreturnId1=[
        $_POST["DelreturnId"]
    ];
    $stmt=$pdo->prepare($sql_DelreturnId1);
    $stmt->execute($arr_DelreturnId1);
    $sql_DelreturnId2="DELETE FROM `returndetail` WHERE `returnId`=?";
    $arr_DelreturnId2=[
        $_POST["DelreturnId"]
    ];
    
    $stmt=$pdo->prepare($sql_DelreturnId2);
    $stmt->execute($arr_DelreturnId2);
}

// echo "<pre>";
// print_r($checkAll);
// echo "</pre>";
// exit();

?>