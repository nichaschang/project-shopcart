<?php
require_once("./db.inc.php");
session_start();
if(isset($_POST['csId'])){
    $_SESSION['csId'] = $_POST['csId'];
};
error_reporting(0);

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
            $("#btnSubmit").on("click",function(){
                
                let pName=$(".carticon-ul").children().find(".pName").text()
                let pName=[];
                console.log(a)
            })
        })
    </script>
    <style>
    .pay-info{
        width:6%;
    }
    .pay-info div {
        letter-spacing:15px;
        padding:50px 15px;
    }
    .invoice-box label{
        color:red;
    }
    .text-vertical-lr{
        writing-mode:vertical-lr;
    }
    .credit-Num{
        width:8%;
        text-align:center;
    }
    .invoice div{
        letter-spacing:15px;
        padding:10px 15px;
    }
    .receiver{
        width:6%;
    }
    .receiver div{
        letter-spacing:15px;
        padding:25px 15px;
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
    <!-- 從這開始 -->
    <div class="container">
        <table class="buyer-info">
            <tr>
                <td rowspan="4" class="pay-info">
                    <div class="bg-secondary text-white text-center text-vertical-lr">付款資訊</div>
                </td>
                <td>
                    <ul class="d-flex list-unstyled">
                        <li class="mx-3">
                            <span>姓名</span>
                            <input type="text" class="" id="buyer-name" value="" required>
                        </li>
                        <li class="mx-2">
                            <span>手機</span>
                            <input type="text" class="" id="buyer-phone" value="" required>
                        </li>
                        <li class="mx-2">
                            <span>市話</span>
                            <input type="text" class="" id="buyer-tel" required>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="w-100 px-3">
                    <span>信用卡卡號</span>
                    <input type="text" class="credit-Num" value="" maxlength="4" required>
                    <input type="text" class="credit-Num" value="" maxlength="4" required>
                    <input type="text" class="credit-Num" value="" maxlength="4" required>
                    <input type="text" class="credit-Num" value="" maxlength="4" required>
                </td>
            </tr>
            <tr>
                <td class="d-flex mt-2">
                    <div class="col-md-4 mb-3">
                        <span>有效期限</span>
                        <input type="text" class="" id="credit-date" value="" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <span>卡片背面後3碼</span>
                        <input type="text" class="w-25" id="credit-backNum" value="" maxlength="3" required>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="px-3">
                    <span>發票地址</span>
                    <input type="text" class="w-75" id="invoice-address" value="" required>
                    <label for="remBuyerData">
                        <input type="checkbox" id="remBuyerData" class="mx-2">購買人資料同會員基本資料
                    </label>
                </td>
            </tr>
            <tr>
                <td rowspan="3" class="invoice">
                    <div class="bg-secondary text-white text-center text-vertical-lr">發票</div>
                </td>
            </tr>
            <tr class="d-flex">
                <td class="d-flex align-items-center mx-2">
                    <input type="radio" name="invoice" class="" id="personal-invoice" required>
                    <label for="personal-invoice" class="d-flex">
                        <span class="m-1">個人電子發票(詳)</span>
                    </label>
                </td>
                <td class="d-flex align-items-center mx-2">
                <input type="radio" name="invoice" class="" id="donate-invoice" required>
                    <label for="donate-invoice" class="d-flex">
                        <span class="m-1">捐贈發票(詳)</span>
                    </label>
                </td>
                <td class="d-flex align-items-center mx-2">
                    <input type="radio" name="invoice" class="" id="business-invoice" required>
                    <label for="business-invoice" class="d-flex">
                        <span class="m-1">公司戶電子發票(詳)</span>
                    </label>
                    <label for="TaxNo">統一編號
                        <input type="text" class="" id="TaxNo" required>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="px-2">
                    <p>依統一發票使用辦法規定：發票一經開立不得任意更改或改開發票</p>
                </td>
            </tr>
            <tr>
                <td rowspan="3" class="receiver">
                    <div class="bg-secondary text-white text-center text-vertical-lr">收貨人</div>
                </td>
                <td>
                    <ul class="d-flex list-unstyled">
                        <li class="mx-2">
                        <label for="receiver-name">姓名</label>
                            <input type="text" id="receiver-name" required>
                        </li>
                        <li class="mx-2">
                            <span>手機</span>
                            <input type="text" class="" id="buyer-phone" required>
                        </li>
                        <li class="mx-2">
                            <span>市話</span>
                            <input type="text" class="" id="buyer-tel" required>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>
                    <ul class="d-flex list-unstyled">
                        <li class="mx-2">
                            <label for="receiver-adress">收件地址</label>
                            <input type="text" class="" id="receiver-adress" size="99" required>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="mx-2">離島地區需收取$100運費 (滿千免運優惠實施中)</p>
                </td>
            </tr>
        </table>
        <div class="w-75 d-flex justify-content-end border-top my-3">
            <button class="btn btn-success my-3" id="btnSubmit">確定送出</button>
        </div>
    </div>
    <?php
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    exit();
    ?>
    <!-- 從這結束 -->
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
    <script>
            
    </script>

</body>

</html>