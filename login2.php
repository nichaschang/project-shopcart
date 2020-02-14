<?php
session_start();
require_once('./db.inc.php');

if(isset($_POST['csId'])){
    $sql = "SELECT `csId`, `csName`
            FROM `customer`
            WHERE `csId` = ? ";
    $arrParam=[
        $_POST["csId"]
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);

    if( $stmt->rowCount() > 0 ){
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Refresh: 0; url=./productSearch2.php");
        $_SESSION['csId'] = $arr[0]['csId'];
        $_SESSION['csName'] = $arr[0]['csName'];
        
    }else{
        header("Refresh: 0; url=./login2.php");
        echo "登入失敗…3秒後自動回登入頁";
    };
    
}else{
    header("Refresh: 3; url=./login.php");
    echo "請確實登入…3秒後自動回登入頁";
}