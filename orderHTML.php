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

    <title>INSPINIA | E-commerce</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
</head>

<body>

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
                <table class="table table-stripped toggle-arrow-tiny" data-page-size="15" data-paging="true">
                    <thead>
                        <tr>
                            <th>
                                <label for="allcheck">
                                    <input type="checkbox" id="allcheck">全選/取消全選
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
                            <td>總金額</td>
                            <td  name='created_at' class='created_at'><?php echo $arr[$i]['created_at']; ?></td>
                            <td name='paymentType' class='paymentType'><?php echo $arr[$i]['paymentCName']; ?></td>
                            <td name='orderStatus' class='orderStatus'><?php echo $arr[$i]['outStatus']; ?></td>
                            <td>
                                <button class="btn-primary btn btn-xs">訂單內容</button>
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
                    <tfoot>
                    <tr>
                        <td colspan="7">
                            <ul class="pagination float-right"></ul>
                        </td>
                    </tr>
                    </tfoot>
                </table>
    
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

    <!-- FooTable -->
    <script src="js/plugins/footable/footable.all.min.js"></script>

    <!-- Page-Level Scripts -->
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