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
    //全選功能
        $("#allcheck").change(function() {
            if (this.checked) {
                $(".check_it").each(function() {
                this.checked=true;
                });
            }else{
                $(".check_it").each(function() {
                this.checked=false;
                });
            }
        });
        //單向點擊功能
        $(".check_it").click(function () {
            if ($(this).is(":checked")) {
                let Tocheck = 0;
            $(".check_it").each(function() {
                if (!this.checked)
                Tocheck = 1;
            });            
            if (Tocheck == 0) {
                $("#allcheck").prop("checked", true);
            }     
        }else {
           $("#allcheck").prop("checked", false);
        }
    });
    //傳送資料功能
        $(document).on('click','button#check_out',function(){
            console.log($(this.closest('tr').childNodes[3]).html());
            let orderId=$(this.closest('tr').childNodes[3]).html();
            $.ajax({
                method:"POST",
                url:"outlist2.php",
                data:{
                    "orderId":orderId
                }
            }).done(function(json){
                // alert(json)
                location.reload(json);
            })
        })
        // console.log($(".allCheck_out"));
        $(document).on('click','button.allCheck_out',function(){
            
            console.log($(".allCheck_out"));
            $(".check_it").each(function() {
                let orderId=$(this.closest('tr').childNodes[3]).html();
                if (this.checked){
                    $.ajax({
                        method:"POST",
                        url:"outlist2.php",
                        data:{
                            "orderId":orderId
                        }
                    }).done(function(json){
                        location.reload(json)
                    })
                }
            })
        })
        
    });
    </script>
    <style>
               table{
                   width:100%;
                   border-collapse: collapse;
                   margin:0 auto;
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
                /* border:1px solid #eee; */
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
               .color {
                   background: #eee;
                }
                .minWidth {
                    width:5%;
                    /* border-right:1px solid #eee; */
                }
                .mWidth{
                    width:15%;
                }
                .btnTop{
                    float:right;
                }
                .allCheck_list a {
                    color:#fff;
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
                            <li><a href="paymentType.php">付款方式編輯</a></li>
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
                    <h2>等待出貨單</h2>
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
                            <!-- ibox-content -->
                            <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                                <div class="ibox-content m-b-sm border-bottom">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="order_id">會員ID</label>
                                                <input type="text" id="order_id" name="order_id" value="" placeholder="Order ID" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="status">訂單狀態</label>
                                                <input type="text" id="status" name="status" value="" placeholder="Status" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="customer">購買人名稱</label>
                                                <input type="text" id="customer" name="customer" value="" placeholder="Customer" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
            <?php
    // 呼叫所有待出貨資料
    $sql="SELECT `payment`.`paymentId`,`payment`.`paymentName`,`payment`.`paymentCName`,`orderlist`.`orderId`,`orderlist`.`csId`,`orderlist`.`total`,`orderlist`.`paymentType`,`orderlist`.`orderStatus`,`orderlist`.`outStatus`,`orderlist`.`created_at` 
    FROM `orderlist` INNER JOIN `payment` 
    WHERE `outStatus`='待出貨' 
    AND  `orderlist`.`paymentType`=`payment`.`paymentName`
    ORDER BY `orderlist`.`created_at` ASC ";

    //TODO 獲取使用者id
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // 判斷是否0筆以上
    if($stmt->rowCount() > 0){
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //TODO 撈出該使用者的指定欄位
            ?>
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>
                                <label for="allcheck">
                                    <input type="checkbox" id="allcheck" class="checkbox-info">全選/取消全選
                                </label>
                            </th>
                            <th data-hide="phone">訂單編號</th>
                            <th data-hide="phone">總金額</th>
                            <th data-hide="phone">購買時間</th>
                            <th data-hide="phone">付款方式</th>
                            <th data-hide="phone">訂單狀態</th>
                            <th data-hide="phone">訂單內容</th>
                            <th data-hide="phone">確認出貨</th>
                        </tr>
                    </thead>
                    <?php
        // 顯示所有訂單筆數及內容 
        for($i=0;$i<count($arr);$i++){

        ?>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" class="check_it">
                            </td>
                            <td name='orderId'' class='orderId minWidth'><?php echo $arr[$i]['orderId'];?></td>
                            <td><?php echo $arr[$i]['total'];?></td>
                            <td  name='created_at' class='created_at'><?php echo $arr[$i]['created_at']; ?></td>
                            <td name='paymentType' class='paymentType'><?php echo $arr[$i]['paymentCName']; ?></td>
                            <td name='orderStatus' class='orderStatus'><?php echo $arr[$i]['outStatus']; ?></td>
                            <td>
                                <a href="./outdetail.php?orderId=<?php echo $arr[$i]['orderId'];?>" class="btn btn-success order_detail">訂單內容</a>
                            </td>
                            <td>
                                <button class="btn btn-danger" id="check_out">確認出貨</button>
                            </td>
                        </tr>
                    </tbody>
                    <?php
        }
    }
    ?>
                </table>
    
            </div>
        </div>
    </div>
</div>


                            <!-- ibox-content -->
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
    <!-- Data picker -->
    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>


    <script>
        $(document).ready(function() {

            $('#date_added').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#date_modified').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });

    </script>
</body>

</html>