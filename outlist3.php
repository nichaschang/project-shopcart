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
        //單選check影響全選是否勾選
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
    //傳送詳細內容資料
        $(document).on('click','button.order_detail',function(){
            // console.log($(this.closest('tr').childNodes[1]).html());
            let orderId=$(this.closest('tr').childNodes[1]).html();
            $.ajax({
                method:"POST",
                url:"./outlist2.php",
                data:{
                    "orderId":orderId
                }
            }).done(function(json){
                location.reload(json);
            })
        })
    $("#order_id").on("keyup",function(){
        $(".orderId").each(function(i,v){
            let Num=Number($(this).text())
            //TODO輸入3能進入if 但是卻沒有hide 
            if(Num==$("#order_id").val()){
                $(".orderId").closest("tr").hide()
                $(this).closest("tr").show()
                return false;
            }
            if(false ||$("#order_id").val()!=Num){
                $(".orderId").closest("tr").show()
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
                    <h2>已完成出貨單</h2>
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
                                <div class="col-form-label w-100 text-center d-flex">
                                    <span  class="d-flex align-items-center justify-content-center p-2" style="background:#f3f3f4" >訂單編號</span>
                                    <input type="text" placeholder="搜尋訂單ID" id="order_id" class="text-left w-75 p-2">
                                </div>
                                    
                            <?php
                            // 獲取所有已出貨的訂單
    $sql="SELECT * FROM `orderlist` WHERE `outStatus`!='訂單成立'
    ORDER BY `orderlist`.`updated_time` ASC ";

    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // 訂單大於0筆以上
    if($stmt->rowCount() > 0){
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            ?>
        <table>
            <thead>
                <tr>
                    <th>訂單編號</th>
                    <th>出貨日期</th>
                    <th>出貨狀態</th>
                    <th>訂單內容</th>
                </tr>
            </thead>              
<?php
// 獲得訂單內容
        for($i=0;$i<count($arr);$i++){
        ?>
                    <tbody>
                        <tr>
                            <td name='orderId'' class='orderId'><?php echo $arr[$i]['orderId'];?>
                            </td>                            
                            <td  name='updated_time' class='updated_time'><?php echo $arr[$i]['updated_time']; ?>
                            </td>
                            <td name='outStatus' class='outStatus text-danger'><?php echo $arr[$i]['outStatus']; ?>
                            </td>
                            <td class='mWidth'>
                            <a href="./outdetail.php?orderId=<?php echo $arr[$i]['orderId'];?>" class="btn btn-success order_detail">訂單內容</a>
                            </td>
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