<?php
require_once("./db.inc.php");
session_start();

if(isset($_POST['csId'])){
    $_SESSION['csId'] = $_POST['csId'];
};
error_reporting(0); //忽略錯誤
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
         //加入購物車
        $(".join_btn").on("click",function(){
            tt();
            $(".shopcartNum").removeClass("none")
            let pIdCount=$(".pId").length
            let tbodyCount=$("tobody").length
            // console.log("aaaaa",tbodyCount)
            let table=$(".cartItem")
            let pId=$(this).siblings().eq(1).text()
            let pName=$(this).siblings().eq(2).text()
            let price=$(this).siblings().eq(3).text()
            // console.log()
            let flag=0;
            $(".pId").each(function(i,v){
                // console.log(v)
                let pIdCart=v.textContent;
                let pIdVal=$(".Qty").eq(i);
                let res=pIdVal.val()*1;
                // console.log(pId2) 
                if(pIdCart==pId){
                    res+=1
                    pIdVal.val(res)
                    flag+=1
                }
            })
            if(flag==0){
                
            pIdCount+=1;
            $(".shopcartNum").text(pIdCount)
                    table.append(
                        `<tbody>
                            <tr>
                                <td name='pId' class='pId'>${pId}</td>
                                <td> <img class="p-2" src="./img/p5.jpg" alt=""></td>
                                <td name='pName' class='pName'>${pName}</td>
                                <td name='price' class='price'>${price}</td>
                                <td>
                                    <input type="text" name="count" class="Qty" value="1">
                                </td>
                                <td class='orderCheck' style="display:none">111</td>
                                <td class="sCount">${price}</td>
                                <td><a href="./delete.php?deleteId=${pId}"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        </tbody>`);
                    $(".carticon-ul").prepend(`
                    <li class="d-flex cart-li">
                    <img src="./img/p5.jpg" class="pImg m-1">
                    <div class="d-flex flex-column col">
                        <span>${pName}</span>
                        <span>${price}</span>
                    </div>
                    <div>
                        <a href="./delete.php?deleteId=${pId}">delete</a>
                    </div>
                </li>
                    `);
                }
            $(".Qty").change();

            $.ajax({
                    method:"POST",
                    url:"addCart.php",
                    data:{
                    "csId":$('#csId').html(),
                    "pId":pId,
                    "pName":pName,
                    "price":price
                    }
                })
        })

        let allTotal=document.querySelector("#theTotal");
        function tt(total) {
            total=0;
            $('.sCount').each(function(){
                let a=$(this).html()*1;
                total +=a;
                allTotal.innerHTML=total;        
            })// 計算總額
        }tt()
        $(document).on('keyup change','.Qty',function() {
            let a=$(this).val(); //數量
            let b=$(this.closest('tr').childNodes[7]).html();
            $(this.closest('tr').childNodes[13]).html(a*b);
            $('.sCount').each(function(){
                tt();
            })
            let Num=a*1;
            if(Boolean(Num) || a==0){
            }else{
                alert("請輸入數字")
                $(this).val('')
            }
        })
        $(document).on('click','button#check_out',function(){
            let countArr=[];
            let DpIdArr=[];
            let pIdArr=[];
            let shippingmway;
            $("[name='pickupway']").each(function(){
                
                if($(this).is(':checked')){
                    shippingmway=$(this).next().text()
                }
            })
            console.log(shippingmway)
            $('.Qty').each(function(){
                let count=$(this).val()*1;
                let p=$(this.closest('tr').childNodes[1]).html();
                // console.log(count)
                if(count!=0){
                    countArr.push(count);
                    pIdArr.push(p);
                }else{
                    DpIdArr.push(p);
                }
            });
            let paymentType;
            $('.paymentType').each(function(i,v){
                let payment=$(this.closest('label').childNodes[1]).val();
                if($(this).is(":checked")){
                    paymentType=payment;
                }
            })
            
                if(countArr.length>0){
                $.ajax({
                    method:"POST",
                    url:"out.php",
                    data:{
                        "count":countArr,
                        "pId":pIdArr,
                        "DpId":DpIdArr,
                        "paymentType":paymentType,
                        "shippingWay":shippingmway,
                        "total":$('#theTotal').html()
                    }
                }).done(function(json){
                    alert(json)
                    window.location.reload()
                })
            }else{
                alert('購物車沒有任何商品');
            }
        })
    });
    </script>
    <style>
               table{
                   width:100%;
               }
               tr{
                   text-align: center;
                   border-bottom:1px solid #eee;
               }
               th{
                   background: #eee;
               }
               input {
                   border:1px solid #eee;
                   text-align:center;
               }
               img {
                   width:6em;
                   height:6em;
               }
               .tspan{
                   font-size:2em;
                   color:#f00;
                   padding-left:10px;
               }
               .f-right{
                   float:right;
                   margin-right:30px;
               }
               #check_out a{
                color:#000;
               }
               label{
                   margin:30px 10px 30px 5px;
               }
               .fa-trash {
                   font-size:1.2em
               }
           </style>
</head>

<body>

    <div id="wrapper">
        <!-- 左側選單 -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <!-- 個人資料選單 -->
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" src="img/profile_small.jpg" />
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold" id="csId"><?php echo $_SESSION['csId']?></span>
                            </a>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">會員功能</span><span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="./productSearch2.php">商品搜尋</a></li>
                            <li><a href="./index2.php">購物車</a></li>
                            <li><a href="./orderlist.php">訂單列表</a></li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">企業端功能</span><span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="outlist.php">等待出貨單</a></li>
                            <li><a href="outlist3.php">已完成出貨單</a></li>
                            <li><a href="returnlist.php">申請退貨單</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </nav>
        <!-- Body -->
        <div id="page-wrapper" class="gray-bg">
            <!-- 上側選單 -->
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                            </a>
                        </li>
                        <li>
                            <?php require_once("./carticon.php")?>
                        </li>

                        <li>
                            <a href="./login.php">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <!-- 標題 -->
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>購物車</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Shop Cart
                        </li>
                        <li class="breadcrumb-item active">
                            <strong> Search Page</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- 內文 -->
            
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <table class="cartItem">
                                    <thead>
                                    <tr>
                                        <th>pId</th>
                                        <th>產品圖</th>
                                        <th>pName</th>
                                        <th>price</th>
                                        <th>數量</th>
                                        <th>小計</th>
                                        <th>功能</th>
                                    </tr>
                                    </thead> 
                            <?php
    $sql_customerCart="SELECT `csId`,`product`.`pId`,`product`.`pName`,`product`.`price`,`shopcart`.`count`,`shopcart`.`pId` FROM `shopcart` INNER JOIN `product` WHERE `product`.`pId`=`shopcart`.`pId` AND `csId`=? ";
    
    $csId = $_SESSION['csId'];
    $arrParam = [
        $csId
    ];
    //TODO 獲取使用者id
    $stmt = $pdo->prepare($sql_customerCart);
    $stmt->execute($arrParam);
    
        if($stmt->rowCount() > 0){
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //TODO 撈出該使用者的指定欄位
            ?>             
<?php
        for($i=0;$i<count($arr);$i++){
           //TODO 根據數量增加tag欄位                  
           $sql="SELECT * FROM `shopcart` INNER JOIN `product` WHERE `csId`=?";
            $arr_cart=[
                $csId
            ];
           $stmt=$pdo->prepare($sql);
           $stmt->execute($arr_cart);
           $stotal=$arr[$i]['price']*$arr[$i]['count'];
        ?>
                    <tbody>
                        <tr>
                            <td name='pId' class='pId'><?php echo $arr[$i]['pId']?></td>
                            <td> <img class="p-2" src="./img/p5.jpg" alt=""></td>
                            <td name='pName' class='pName'><?php echo $arr[$i]['pName']?></td>
                            <td name='price' class='price'><?php echo $arr[$i]['price']?></td>
                            <td>
                                <input type="text" name="count" class="Qty" value="<?php echo $arr[$i]['count']?>">
                            </td>
                            <td  class='orderCheck' style="display:none"><?php echo $arr[$i]['orderCheck']?></td>
                            <td class="sCount"><?php echo $stotal?></td>
                            <td><a href="./delete.php?deleteId=<?php echo $arr[$i]['pId']?>"><i class="fa fa-trash"></i></a></td>
                        </tr>
                   </tbody>
        <?php
        };
    }
?>
</table>

<div class="f-right">總額：<span class="tspan" id="theTotal"></span></div>
<br>
<hr>
<p>宅配方式</p>
<input type="radio" id="radio_delivery" name="pickupway" checked>
<label for="radio_delivery">宅配到府</label>

<input type="radio"id="radio_24hMarket" name="pickupway">
<label for="radio_24hMarket">7-11超商取貨</label>

<input type="radio" id="li_24hMarket_FM" name="pickupway">
<label for="li_24hMarket_FM">全家超商取貨</label>

<input type="radio" id="li_24hMarket_CVS" name="pickupway">
<label for="li_24hMarket_CVS">萊爾富超商取貨</label>

<input type="radio" id="li_24hMarket_IPOST"name="pickupway">
<label for="li_24hMarket_IPOST">郵局</label>
<br>

<?php $sql_addShopcart="SELECT * FROM `product`";

$stmt=$pdo->prepare($sql_addShopcart);
$stmt->execute();
$arr_addShopcart=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="d-flex row">
    <table class="table border col-4 mx-1">
        <tr>
            <th class="text-left" colspan="3">信用卡付款方式:</th>
        </tr>
        <tr>
            <td><button class="btn btn-success">一次付清</button></td>
            <td><button class="btn btn-success">紅利折抵</button></td>
            <td><button class="btn btn-success">分期付款</button></td>
        </tr>
    </table>
    <table class="table border col-4 mx-1">
        <tr>
            <th class="text-left" colspan="3">其他付款方式</th>
        </tr>
        <tr>
            <td><button class="btn btn-success">貨到付款</button></td>
            <td><button class="btn btn-success">ATM轉帳</button></td>
            <td><button class="btn btn-success">iBon付款</button></td>
        </tr>
    </table>
</div>
<ul class="d-flex list-unstyled">
    
<?php
$sql_payment="SELECT * FROM `payment`";
$stmt=$pdo->prepare($sql_payment);
$stmt->execute();
if($stmt->rowCount()>0){
    $arr=$stmt->fetchAll(PDO::FETCH_ASSOC);
    for($i=0;$i<count($arr);$i++){
?>
<li>
<label for="<?php echo $arr[$i]['paymentName']?>">
    <input type="radio" class="paymentType" name="paymentType" id="<?php echo $arr[$i]['paymentName']?>" value="<?php echo $arr[$i]['paymentName']?>"><?php echo $arr[$i]['paymentCName']?>
</label>

</li>
<?php
    }
}
?>

</ul>
<div name='csId' style="display:none"><?php echo $_SESSION['csId'];?></div>
<button id="check_out" class="btn btn-primary">結帳</button>
<a href="productSearch2.php"><button class="btn btn-primary">繼續購物</button></a>
<p>猜你喜歡</p>
<hr>
<ul class="my-3 list-unstyled d-flex flex-wrap">
    <?php
    $sql_rndProduct="SELECT * FROM `product` ORDER BY RAND() ASC LIMIT 5 ";
    $stmt=$pdo->prepare($sql_rndProduct);
    $stmt->execute();
    $arr_rndProduct=$stmt->fetchAll(PDO::FETCH_ASSOC);
    for($i=0;$i<count($arr_rndProduct);$i++){
    ?>
        <li class="border p-3 m-3">
            <div class="d-flex flex-column">
                <img class="p-1" src="./img/p5.jpg" alt="">
                <p class="p-2 pId-cart"><?php echo $arr_rndProduct[$i]["pId"]?></p>
                <p class="p-2 pName-cart"><?php echo $arr_rndProduct[$i]["pName"]?></p>
                <p class="p-2 price-cart"><?php echo $arr_rndProduct[$i]["price"]?></p>
                <button class="btn btn-info join_btn"><i class="fa fa-cart-plus"> 加入購物車</i></button>
            </div>    
        </li>
        
    <?php
    }
    ?>

    
</ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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