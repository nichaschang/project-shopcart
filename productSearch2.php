<?php
session_start();

if(isset($_POST['csId'])){
    $_SESSION['csId'] = $_POST['csId'];
}
require_once("./db.inc.php");
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Search Page</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Noto Sans TC">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
            $(document).on("click","button#join_btnS",function(){
                $.ajax({
                    method:'POST',
                    url:"productSearch.php",
                    data:{
                        "pId":$('#pId').html(),
                    }
                })
            })
        });// 抓取產品ID
        
        $(document).ready(function(){
            
            $(document).on("click","button#join_btn",function(){
                $(".cartMsg").css("opacity",1);     
                $.ajax({
                    method:'POST',
                    url:"addCart.php",
                    data:{
                    "csId":$('#csId').html(),
                    "pId":$('.pId').html(),
                    "pName":$('.pName').html(),
                    "price":$('.price').html()
                    }
                }).done(function(){
                    setTimeout(() => {
                        $(".cartMsg").css("top","25%")
                        // $(".cartMsg div").css("left","120%")  
                        $(".cartMsg").css("transition",0.3).css("opacity",0)        
                    }, 600);
                    setTimeout(() => {
                        $(".cartMsg").css("top","30%")
                        // $(".cartMsg div").css("left","20%")
                    }, 1200);
                })
            })
        });// 抓取加入購物車的相關資訊
    </script>
    <style>
    .inputbox {
        height:31px;
        border:1px solid #ccc;
    }
    .cartMsg {
        width:180px;
        height:160px;
        border:3px solid #ccc;
        border-radius:10px;
        text-align:center;
        padding-top:25px;
        opacity:0;
        transition:1s;
        position:absolute;
        left:40%;
        top:30%;
        overflow:hidden;
    }
    .cartMsg div {
        position:absolute;
        transition:1s;
        top:20%;
        left:20%;
        overflow:hidden;
    }
    .cartMsg img {
        width:80px;
        heigth:30px;
    }
    .cartMsg p {
        color:#666;
        font-size:1.3em;
        font-family:"Noto Sans TC";
        padding-top:10px;
        white-space:nowrap;
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
                            <a href="login.php">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <!-- 標題 -->
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>商品搜尋</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            會員功能
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
                            <div class="cartMsg">
                                <div>
                                <img src="./img/cart-plus-solid.svg" alt="">
                                <p>已加入購物車</p>
                                </div>
                            </div>
                                <form name="myForm" method="POST" action="">
                                    <input type="text" id="pId" name="pId" class="inputbox" value="">
                                    <button id="join_btnS" class="btn btn-success"><i class="fa fa-search"> 搜尋</i></button>
                                    
                                </form>
                                <br>
                                <?php require_once("./productSearch.php");?>
                                <div class='d-none'>使用者編號：<span id='csId'><?php echo $_SESSION['csId'];?></span> </div> 
                                <button id="join_btn" class=" btn btn-primary"><i class="fa fa-cart-plus"> 加入購物車</i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        

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