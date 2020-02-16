<?php
require_once("./db.inc.php");
session_start();
$_SESSION['orderId']=$_GET['orderId'];
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
        //列印
        $(document).on('click','.order_print',function(){
            window.print();
        })  
    })
    
    </script>
    <style>
               .itemTable{
                   width:100%;
                   border-collapse: collapse;
               }
               .itemTable tr{
                   text-align: center;
                   border-bottom:1px solid #ddd;
               }
               td {
                padding:15px;
               }
               input {
                   border:1px solid #eee;
                   text-align:center;
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
                .order_print{
                    margin:6px;
                    float:right;
                }
                .minWidth {
                    width:5%;
                }
                .mWidth{
                    width:15%;
                }
                .cusTable {
                    border:1px solid #f85;
                    height:100px;
                    font-size:1.2em;
                    width:100%;
                }
                .cusTable tr{
                    text-align:center;
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
                    <h2>詳細資料</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Extra Pages
                        </li>
                        <li class="breadcrumb-item active">
                            <strong> itemslist Page</strong>
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
    // 呼叫該訂單編號的產品及購買人資料
    $sql="SELECT `orderdetail`.`orderId`,`orderlist`.`orderId`,`orderlist`.`orderId`,`orderdetail`.`orderId`,`orderdetail`.`pId`,`product`.`pId`,`orderlist`.`created_at`,`product`.`price`,`orderdetail`.`count`,`total`,`product`.`pName`,`customer`.`csName`,`customer`.`csAdress`,`customer`.`csPhone`
    FROM `orderlist` INNER JOIN `orderdetail` JOIN `product` JOIN  `customer`
    WHERE `orderdetail`.`orderId`=?
    AND `orderlist`.`orderId`=`orderdetail`.`orderId` AND `orderdetail`.`pId` = `product`.`pId` AND `customer`.`csId`=`orderlist`.`csId`";

    $arrParam = [
        $_SESSION['orderId']
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    ?>
    <table class="cusTable mWidth">
        <thead>
            <tr class="colorOra" style="border:1px solid #f85">
                <th class="mWidth">顧客姓名</th>
                <th>寄件地址</th>
                <th>連絡電話</th>
            </tr>
        </thead>
        <?php
        // 確認0筆以上
    if($stmt->rowCount() > 0){
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //TODO 會員呼叫更改為訂單購買人資料 (未完成)
        
        // 獲得購買人姓名地址電話
            ?>  <tbody>
            <tr>
                <td><?php echo $arr[0]['csName'];?></td>
                <td><?php echo $arr[0]['csAdress'];?></td>
                <td><?php echo $arr[0]['csPhone'];?></td>
            </tr>
        </tbody>  
    </table>
    <br><br>
               <table class="itemTable">
                   <thead>
                   
                   <tr class="colorGrey" stkle="border-bottom:1px solid #eee;">
                       <th class="mWidth">訂單編號</th>
                       <th>產品名稱</th>
                       <th>數量</th>
                   </tr>
                   </thead>              
<?php
        // 獲得訂單購買產品及數量 
        //TODO 將訂單編號丟入上方會員資料上
        for($i=0;$i<count($arr);$i++){
            $Scount=$arr[$i]['price']*$arr[$i]['count'];

        ?>
                    <tbody>
                        <tr>
                            <td name='orderId'' class='orderId'><?php echo $arr[0]['orderId'];?>
                            </td>                            
                            <td  name='pName' class='pName'><?php echo $arr[$i]['pName']; ?>
                            </td>
                            <td name='count' class='count'><?php echo $arr[$i]['count']; ?>
                            </td>      
                              
                        </tr>
                   </tbody>
        <?php
        };
    }
?>

</table>
                            </div>
                            <a href="./outlist.php" class="btn btn-success order_detail">回出貨表格</a>
                            <div><button class="btn btn-success order_print">列印出貨單</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Footer -->
        <div class="footer">
            <div class="float-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2018
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