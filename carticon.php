<?php
require_once("./db.inc.php");
session_start();

if(isset($_POST['csId'])){
    $_SESSION['csId'] = $_POST['csId'];
}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Search Page</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script>
    $(document).ready(function(){
        $(".carticon-li").on("click",function(){
            $(".carticon-box").removeClass("none")
        })
     $(".carticon-box").on("mouseleave",function(){
        //  $(".carticon-box").addClass("none");
        //  console.log(123)
     })
     let shopcartNum=$(".shopcartNum").text()
    //  console.log(shopcartNum)
     if(shopcartNum==0){
        // $(".shopcartNum").addClass("none")
     }else{
        $(".shopcartNum").removeClass("none")
     }
    })
     
    </script>
    <style>
        body{
            background: #fff;
        }
        .carticon{
            width:20px;
            height:20px;
            display:block;
            cursor:pointer;
        }
        .carticon-box{
            width:300px;
            /* height:100%; */
            border:1px solid #bbb;
            background:#eee;
            position:absolute;
            left:-500%;
            top:100%;
            z-index:20;
            overflow:hidden;
        }
        
        .cart-li{
            display:block;
        }
        .cart-li:hover{
            color:red;
            background:rgba(180,180,180,0.6);
        }
        .none{
            display: none;
            opacity:0;
            height:0;
        }
        .pImg{
            width:50px;
            height:50px;
        }
        .checkout-icon{
            width:100%;
        }
        .shopcartNum{
            width:20px;
            height:20px;
            border-radius:50%;
            background: #f00;
            color: #fff;
            text-align: center;
            position: absolute;
            left:55%;
            top:-15%;
        }
        #cart-box{
            width:20px;
            height:20px;
        }
        .p-count{
            text-align: center;
        }
    </style>
</head>

<body>
<div class="position-relative carticon-li px-2                           ">
    <?php 
        $sql_shopcartIcon="SELECT * FROM `shopcart` INNER JOIN `product` WHERE `product`.`pId`=`shopcart`.`pId` AND `csId`=?";
        $arr_shopcartIcon=[
            $_SESSION["csId"]
        ];
        $stmt=$pdo->prepare($sql_shopcartIcon);
        $stmt->execute($arr_shopcartIcon);

        $arr=$stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="position-relative" id="cart-box">
            <div class="shopcartNum"><?php echo count($arr)?></div>
            <img src="./img/shopping-cart-solid.svg" class="carticon">
        </div>
        <div class="carticon-box d-flex flex-column rounded none">
            <p class="m-2">最近加入項目</p>
        <ul class="list-unstyled carticon-ul">
        <?php
        for($i=0;$i<count($arr);$i++){
            ?>
            <li class="d-flex cart-li p-2 align-items-center">
                    <img src="./img/p5.jpg" class="pImg m-1">
                    <div class="d-flex flex-column col">
                        <span class="pId d-none"><?php echo $arr[$i]["pId"]?></span>
                        <span class="pName"><?php echo $arr[$i]["pName"]?></span>
                        <span class="price">$<span><?php echo $arr[$i]["price"]?></span></span>
                    </div>
                    <div class="col">
                        <input class="p-count" type="text" value="<?php echo $arr[$i]["count"]?>" size="8"></input>
                    </div>
                    <div>
                        <a href="./delete.php?deleteId=<?php echo $arr[$i]['pId']?>"><i class="fa fa-trash"></i></a>
                    </div>
                </li>
        
        <?php
        }
        ?>      
            <li class="checkout-icon my-2 border-top py-2"><button class="btn btn-dark btn-block btn-lg">結帳</button></li>
            </ul>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>


</body>

</html>