<?php
require_once('./db.inc.php');
//TODO 獲取產品ID後所執行得動作
error_reporting(0);

    $sql = "SELECT `pId`, `pName`,`price`
            FROM `product`
            WHERE `pId` = ? ";
    $arrParam=[
        $_POST['pId']
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "產品圖";
    echo "<div class='pId'>";
    print_r($rows[0]['pId']);
    echo "</div>";
    echo "<img src='./img/p5.jpg'>";
    echo "<br>";
    echo "產品名稱";
    echo "<div class='pName'>";
    print_r($rows[0]['pName']);
    echo "</div>";
    echo "<br>";
    echo "產品價格";
    echo "<div class='price'>";
    print_r($rows[0]['price']);
    echo "</div>";
    echo "<br>";
?>