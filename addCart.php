<?php
require_once('./db.inc.php');

// exit();
$sql = "SELECT `pId`,`csId`,`count` FROM `shopcart` WHERE `pId`=?  AND `csId`=?";
$arrParam = [
    $_POST['pId'],
    $_POST['csId'] 
];



$stmt=$pdo->prepare($sql);
$stmt->execute($arrParam);


if($stmt->rowCount()>0){
   
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    

    if($arr['csId'] == $_POST['csId']){
        
        $sql = "UPDATE `shopcart` SET `count` =`count`+1 WHERE `pId`=? AND `csId`=?";    
        $stmt = $pdo->prepare($sql);
        $arrParam = [
           $_POST['pId'],
           $_POST['csId']  
        ];

        $stmt->execute($arrParam);
        
    }
}else{
    $sql = "INSERT INTO `shopcart`(`pId`,`csId`,`count`) VALUES (?,?,1)";          
        $arrParam = [ 
            $_POST['pId'],
           $_POST['csId']
        ];

        $stmt = $pdo->prepare($sql);
        $stmt->execute( $arrParam);    
}

//TODO  從網頁上抓取的值 上傳置資料庫
    // $sql = "SELECT * FROM `shopcart` WHERE `pId`=? AND `csId`=?";
                
    // $arrParam=[
    //     $_POST['pId'],
    //     $_POST['csId']
        
    // ];
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute($arrParam);
    // $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);        
    // echo json_encode($arr);
?>