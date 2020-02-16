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
        
        $(".outStatusTxt").each(function(i,v){
            // console.log(v.html())
            let Status=$(this).html();
            switch(Status){
                case "退貨完成":
                $(this).css('color','#f90');
                break;
                case "訂單成立":
                let btn=$(this).closest("tr").find(".returnBtn")
                btn.attr("href","javascript:void(0)");
                style={
                    background:"#ccc",
                    color:"#000",
                    border:"none"
                }
                btn.css(style)
                break;
                default:
                break;
            }
            
        })
       
    });
    </script>
    <style>
               table{
                   width:100%;
                   border-collapse: collapse;
               }
               tr{
                   text-align: center;
                   border-bottom:1px solid #eee;
               }
               th{
                   background: #eee;
               }
               td {
                padding:15px;
               }
               input {
                   border:1px solid #eee;
                   text-align:center;
               }
               img {
                   width:6em;
                   height:6em;
               }
                .outStatusTxt {
                    padding:8px;
                    border-radius:3px;
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
                    <h2>購買紀錄</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Shop History
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
                            
                                    
                            <?php
    $sql="SELECT `orderlist`.`paymentType`,`orderlist`.`orderId`,`orderlist`.`csId`,`orderlist`.`total`,`orderlist`.`outStatus`,`orderlist`.`created_at`
    FROM `orderlist` WHERE `orderlist`.`csId`=?";

    $csId = $_SESSION['csId'];
    $arrParam = [
        $csId
    ];
    //TODO 獲取使用者id
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    
    if($stmt->rowCount() > 0){
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //TODO 撈出該使用者的指定欄位
            ?>
               <table>
                   <thead>
                   <tr>
                       <th>訂單編號</th>
                       <th>購買日期</th>
                       <th>訂單狀態</th>
                       <th>出貨狀態</th>
                       <th>總金額</th>
                       <th>結帳方式</th>
                       <th>功能</th>
                       <th>其他</th>
                   </tr>
                   </thead>              
<?php
        for($i=0;$i<count($arr);$i++){
        ?>
                    <tbody>
                        <tr>
                            <td name='orderId'' class='orderId'><?php echo $arr[$i]['orderId'];?></td>                            
                            <td name='created_at' class='created_at'><?php echo $arr[$i]['created_at']; ?></td>
                            <td name='outStatus' class='outStatus'><span class="outStatusTxt"><?php echo $arr[$i]['outStatus']; ?></span></td>
                            <td name='total' class='total'><?php echo $arr[$i]['total']; ?></td>
                            <td name='paymentType' class='paymentType'><?php echo $arr[$i]['paymentType']?></td>
                            <td>
                            <a href="./orderdetail.php?orderId=<?php echo $arr[$i]['orderId'];?>" class="btn btn-success order_detail">詳細資料</a>
                            </td>  
                            <td><a href="return.php?orderId=<?php echo $arr[$i]['orderId'];?>" class="btn btn-danger returnBtn">申請退貨</a></td>            
                        </tr>
                   </tbody>
        <?php
        };
    }
?>
</table>

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