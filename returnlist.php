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
    
    //隱藏的內容
    $(".itemInfo").hide();
    $(".itemtitle").hide();
    $(".returnPayHead").hide();
    let total=0;//加總用

    //點擊後顯示退貨單詳細內容
        $(".btn-itemInfo").on("click",function(){
        $(".itemInfo").hide();
        $(".itemtitle").hide();        
        $(".returnPayHead").hide();
        $(".returnId").css("border-left","none");
        $(this).closest("tbody").find("tr").show();
        $(this).closest("tbody").find(".returnId").css("border-left","6px solid #f35");
        $(this).closest("tbody").find(".itemInfo").css("border-left","6px solid #f55");
        let x=$(this).closest("tr").nextAll().find(".sCount"); //產品小計
        let z=$(this).closest("tr").nextAll().find(".returnPay"); //退貨單總額
        total=0;
            x.each(function(i,v){
                z.html(0)
                let y=$(this).html()*1;
                total+=y
            })
            z.html(total);
        })

        //允許退貨
        $(".btn-returnAllow").on("click",function(){
            let orderId=$(this).closest("tr").find(".orderId").html()
            let returnId=$(this).closest("tr").find(".returnlistId").html()
            let pId=$(this).closest("tr").siblings().find(".pId")
            let pIdarr=[];
            pId.each(function(i,v){
                pIdarr.push(pId.eq(i).html())
            })
            $.ajax({
                method:"POST",
                url:"returnRequire.php",
                data:{
                    "orderId":orderId,
                    "pId":pIdarr,
                    "returnId":returnId
                }
            }).done(function(json){
                // alert(json)
                window.location.reload();
            })
        })

        //拒絕退貨
        $(".btn-returnReject").on("click",function(){
            let DelreturnId=$(this).closest("tr").find(".returnlistId").html()
            $.ajax({
                method:"POST",
                url:"returnRequire.php",
                data:{
                    "DelreturnId":DelreturnId
                }
            }).done(function(){
                window.location.reload();
            })
        })
    });
    </script>
    <style>
               table{
                   width:100%;
                   border-collapse: collapse;
               }
               .returnlist{
                   background: #aaa;
                   color:#000;
                   text-align:center
               }
               .returnlist th{
                padding:12px;
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
               .color {
                   background: #999;
                }
                .outStatusTxt {
                    padding:8px;
                    border-radius:10px;
                }
                .itemInfo {
                    border-bottom:2px solid #eee;
                }
                .itemInfo td{
                    text-align:center;
                    padding:6px 0px;
                    color:#666;
                }
                .sCount {
                    padding:0px 5px;
                }
                .returnId {
                    background:#eee;
                    border-bottom:1px solid #aaa;
                    text-align: center;
                }
                .returnPayHead {
                    font-size:1.2em;
                }
                .returnPayHead td{
                    text-align:right;
                    padding-right:30px;
                }
                .returnPay {
                    color:#f00;
                    padding-left:6px;
                    font-size:1.2em;
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
                    <h2>退貨單申請</h2>
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
                    <table>
                        <thead>
                            <tr class="returnlist">
                                <th>訂單編號</th>
                                <th>退貨單號</th>
                                <th>退貨日期</th>
                                <th>退貨原因</th>
                                <th>詳細資料</th>
                                <th>退貨確認</th>
                            </tr>
                        </thead>
                        <?php
                        // 呼叫退貨申請單
                        $sql_returnlist="SELECT * FROM `returnlist` WHERE `returnStatus`='退貨處理中'";
                        
                        $stmt=$pdo->prepare($sql_returnlist);
                        $stmt->execute();
                        $arr=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                            // 大項目內容呼叫

                            $sql_returnItem="SELECT * FROM `returndetail` INNER JOIN `product` WHERE `returnId`=? AND `returndetail`.`pId`=`product`.`pId`";
                            for($i=0;$i<count($arr);$i++){
                            
                            $arr_returnItem=[
                                $arr[$i]['returnId']
                            ];
                            $stmt1=$pdo->prepare($sql_returnItem);
                            $stmt1->execute($arr_returnItem);
                            $arr1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <tbody class='tBar'>
                            <tr class="returnId">
                                <td class="orderId"><?php echo $arr[$i]['orderId'] ?></td>
                                <td class="returnlistId"><?php echo $arr[$i]['returnId']?></td>
                                <td><?php echo $arr[$i]['created_at']?></td>
                                <td><?php echo $arr[$i]['returnReason']?></td>
                                <td>
                                <button class="btn btn-success btn-itemInfo m-1">商品/客戶資料</button>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-returnAllow mx-3">同意</button>
                                    <button class="btn btn-danger btn-returnReject mx-3">拒絕</button>
                                </td>
                            </tr>
                            
                            <tr class="buyerInfo itemInfo">
                                <td>姓名：<span class="mx-2 font-weight-bold"><?php echo $arr[$i]['buyerName']?></span></td>
                                <td>電話：<span class="mx-2 font-weight-bold"><?php echo $arr[$i]['buyerPhone']?></span></td>
                                <td>地址：<span class="mx-2 font-weight-bold"><?php echo $arr[$i]['buyerAdress']?></span></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php


                            // 退貨單詳細內容及總計的呼叫
                            for($k=0;$k<count($arr1);$k++){
                                $sCount=$arr1[$k]['price']*$arr1[$k]['count']
                                ?>
                                <tr class="itemInfo">
                                    <td class="pId"><?php echo $arr1[$k]['pId']?></td>
                                    <td>$<?php echo $arr1[$k]['price']?></td>
                                    <td class="Count"><?php echo $arr1[$k]['count']?>件</td>
                                    <td>小計：<span class="sCount"><?php echo $sCount?></span></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php
                            }?>
                            <tr class="returnPayHead">
                            <td colspan="4">退貨總額: $<span class="returnPay"></span></td>
                            </tr>
                        </tbody>
                            
                           
                        <?php
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