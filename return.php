<?php 
 session_start();
require_once("./db.inc.php");
if(isset($_POST['csId'])){
    $_SESSION['csId'] = $_POST['csId'];
}
    // $_SESSION['orderId']=$_GET['orderId'];
// echo "<pre>";
// print_r($_GET['orderId']);
// echo "</pre>";
// exit();
// $sql_orderDetail="SELECT * FROM `orderdetail` WHERE `orderId`=?";
// $arr_orderDetail=[
//     $_GET['orderId']
// ];
// $stmt=$pdo->prepare($sql_orderDetail);
// $stmt->execute($arr_orderDetail);
// $arr= $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($_SESSION['orderId']);
// echo "</pre>";
// exit();

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
        let total=0;
        $(document).on('click','.check_return',function(){
            let b=$(this.closest('tr').childNodes[7]).html()*1;
                if(this.checked){
               total+=b
               $('#returnMoney').html(total)
            }else{
                total-=b
                $('#returnMoney').html(total)
            }
        })
        
        $('.outStatus').each(function(i,v){
            
            if($(this).text()=='退貨處理中'){
                $(this).closest("tr").find(".check_return").hide()
            }else if($(this).text()=='退貨完成'){
                $(this).closest("tr").find(".check_return").hide()
            }
        })
        
        $(document).on('click','.enterReturn',function(){
            let buyerName=$('.buyerName').html();
            let buyerPhone=$('.buyerPhone').html();
            let buyerAdress=$('.buyerAdress').html();
            let returnMsg=$('.returnMsg').val();
            let returnPay=$('#returnMoney').html();
            let orderId=$('.orderId').html();
            let pIdarr=[];
            let countarr=[];
            let Num=0;
            $('.check_return').each(function(i,v){
                if($(this).is(":checked")){
                    Num=0
                let pId=$('.itemInfo').eq(i).find('input').val();
                let count=$('.itemInfo').eq(i).find('.count').html();
                    pIdarr.push(pId)
                    countarr.push(count)
                    $.ajax({
                        method:"POST",
                        url:"return1.php",
                        data:{
                            "orderId":orderId,
                            "returnPay":returnPay,
                            "buyerName":buyerName,
                            "buyerPhone":buyerPhone,
                            "buyerAdress":buyerAdress,
                            "returnMsg":returnMsg,
                            "pIdarr":pIdarr,
                            "countarr":countarr
                        }
                    }).done(function(){
                        history.back();
                    })
                }else{
                    Num=1
                }
            })
            if(Num==1){
                alert("沒有選擇任何商品")
            }else{
                console.log(Num)
            }
        })

    })
    </script>
    <style>
               table{
                   width:35%;
                   border-collapse: collapse;
               }
               tr{
                   text-align: left;
               }
               td {
                padding:15px;
               }
               .border-b{
                   border-bottom:1px solid #eee;
               }
               thead tr td:nth-child(1){
                background:#eee;
               }
               .Rproduct th{
                text-align:center;
                letter-spacing:20px;
                padding:5px;
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
               .t-right{
                   text-align:right;
               }
               .colorGrey {
                   background: #eee;
                }
                .colorOra {
                    background: #f85;
                    color:#fff;
                }
                .order_detail{
                    margin:6px;
                    float:right;
                }
                .minWidth {
                    width:5%;
                    
                }
                .mWidth{
                    width:35%;
                    border-bottom:1px solid #eee;
                }
                .btn{
                    margin:10px;
                }
                .btn-prev:hover{
                    color:#fff;
                    
                }
                .smallbox{
                    width:50px;
                    height:50px;
                    float:right;
                    top:40%;
                    
                }
                .mletter {
                    font-size:1.2em;
                }
                .mletter span{
                    font-size:1.8em;
                    padding:0px 8px;
                    color:#f00;
                }
                .tbodyH{
                    background: #eee;
                }
                .tbodyLine{
                    border-bottom:1px solid #eee;
                }
                .returnMsg {
                    width:35%;
                    border:1px solid #aaa;
                }
                textarea {
                    height:100px;
                    resize : none;
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
                                <span class="block m-t-xs font-bold">David Williams</span>
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
                            <li><a href="./productSearch2.php">商品搜尋</a></li>
                            <li><a href="./index2.php">購物車</a></li>
                            <li><a href="./orderlist.php">訂單列表</a></li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">企業端功能</span><span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="outlist.php">待出貨單</a></li>
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
                    <h2>退貨申請</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Extra Pages
                        </li>
                        <li class="breadcrumb-item active">
                            <strong> Return Page</strong>
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
<?php


    $sql_csInfo="SELECT * FROM `orderlist` INNER JOIN `customer` WHERE `orderlist`.`csId`=? AND `orderlist`.`orderId`=? AND `orderlist`.`csId`=`customer`.`csId`";
    $arr_csInfo=[
        $_SESSION['csId'],
        $_GET['orderId']
    ];
        $stmt=$pdo->prepare($sql_csInfo);
        $stmt->execute($arr_csInfo);
        if($stmt->rowCount()>0){
            $arr=$stmt->fetchAll(PDO::FETCH_ASSOC);
       

?>
                                <table>
                                <thead class="border-b">
                                
                                <tr>
                                <td>姓名</td>
                                <td class="buyerName"><?php echo $arr[0]['csName']?></td>
                                </tr>
                                <tr>
                                    <td>電話</td>
                                    <td class="buyerPhone"><?php echo $arr[0]['csPhone']?></td>
                                </tr>
                                <tr>
                                    <td>收件地址</td>
                                    <td class="buyerAdress"><?php echo $arr[0]['csAdress']?></td>
                                </tr>
                                </thead>
                                </table>
                                <br>
                                <p>退貨原因</p>
                                <textarea cols="30" rows="10" class="returnMsg"></textarea>
                                <br>
                                <table>
                                <thead class="border-b Rproduct">
                                <tr>
                                    <th colspan="3">退貨商品</th>
                                </tr>
                                </thead>
<?php
};

?>
                                <tbody>
                                    <tr class="tbodyH">
                                        <th>選擇</th>
                                        <th>商品名稱</th>
                                        <th>商品數量</th>
                                        <th>商品小計</th>
                                        <th></th>
                                    </tr>

<?php 
// 該訂單產品
    $sql_itemInfo="SELECT `orderdetail`.`outStatus`,`orderdetail`.`orderId`,`orderdetail`.`pId`,`orderdetail`.`count`,`product`.`pId`,`product`.`pName`,`product`.`price` FROM `orderdetail` INNER JOIN `product` INNER JOIN `orderlist` WHERE `orderdetail`.`orderId`=? AND `orderdetail`.`pId`=`product`.`pId` AND `orderdetail`.`orderId`=`orderlist`.`orderId`";
    $arr_itemInfo=[
        $_GET['orderId']
    ];
    $stmt=$pdo->prepare($sql_itemInfo);
    $stmt->execute($arr_itemInfo);
    $arr=$stmt->fetchAll(PDO::FETCH_ASSOC);
    for($i=0;$i<count($arr);$i++){
        $sCount=$arr[$i]['count']*$arr[$i]['price']
    ?>
    
                                <tr class="tbodyLine itemInfo">
                                    <td class="pId">
                                    <input type="checkbox" value="<?php echo $arr[$i]['pId']?>" class="check_return">
                                    </td>
                                    <td><?php echo $arr[$i]['pName']?></td>      
                                    <td class="count"><?php echo $arr[$i]['count']?></td>
                                    <td class="sCount"><?php echo $sCount?></td>
                                    <td class="outStatus"><?php echo $arr[$i]['outStatus']?></td>
                                </tr>
                                <!-- style="display:none"  -->
                                </tbody>
 
                                <?php
    }
    ?>
           
                                </table>
                                <span style="display:none" class="orderId"><?php echo $_GET['orderId']?></span>
                                <div class="mletter mWidth t-right">退款金額 $<span id="returnMoney">0</span></div>
                                <button class="btn btn-primary enterReturn">確認</button>
                                <a href="orderlist.php" class="btn btn-danger exitReturn">取消</a>
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