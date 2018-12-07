<!DOCTYPE html>
<?php 
    session_start();
    if($_SESSION['id']== ""){
        echo "PLEASE LOGIN";
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }
    if($_SESSION['status'] != "USER"){
        echo "THIS PAGE FOR USER ONLY";
        exit();
    }
    require("connect.php");
    $sql = "SELECT * FROM userlogin WHERE id='".$_SESSION['id']."' ";
    $query = $connect->query($sql);
    $result = $query->fetch_array();


    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">.
    <?php require "user_includeheader.php"; ?> 
    <link rel="stylesheet" href="css/bootselect.min.css">
    <script src="js/bootselect.min.js"></script>
</head>
<body>
<?php require "user_header.php"; ?>
        <form action="user_showreport.php" method="GET">
            <table class="col-md-12 col-xs-12" border="0">
                <tr>
                    <td class="col-md-4 col-xs-4">ชื่อโครงการ</td>
                    <td class="col-md-8 col-xs-8">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control col-md-12 col-xs-12" name="project_name" data-live-search="true" id="name_row1" >
                            <option> </option>
                                <?php
                                    $sqls ="SELECT * FROM farmer_list GROUP BY project_name";
                                    $rs = $connect->query($sqls);
                                    while ($Result2 = $rs->fetch_array()) {
                                        echo "<option value='".$Result2['project_name']."'>".$Result2['project_name']."</option>";
                                    } 
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-4 col-xs-4">ชื่อเกษตรกร</td>
                    <td class="col-md-8 col-xs-8">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control col-md-12 col-xs-12" name="farmer_name" data-live-search="true" id="com_row1"></select>
                        </div>
                    </td>
                </tr>
                <tr style="text-align:center;" >
                    <td colspan="2" style="padding-top:20px;padding-bottom:20px;"><input type="submit" class="btn btn-success" value="ดูข้อมูล"></td>
                </tr>
            </table>
        </form>
        <center><h3>สรุปรายการเบิกของ</h3></center><br>
        <table border="0" class="table table-bordered">
        <?php
            $project_name = $_GET["project_name"];
            $farmer_name = $_GET["farmer_name"];
            echo "<tr>";
            echo "<th colspan='4'>ชื่อเกษตรกร : <span style='color:blue;' >".$farmer_name."</span></th>";
            echo "</tr>";
            $sumtotal = 0;
            $sumtotal2 = 0;
            $sql = "SELECT * FROM order_list WHERE project_name='$project_name' AND farmer_name='$farmer_name' GROUP BY order_date ORDER BY order_date DESC ";
            $qry = $connect->query($sql);
            while($show = $qry->fetch_array()){
                echo "<tr>";
                echo "<th colspan='4' style='color:red;'>".date('D j-n-Y',strtotime($show['order_date']))."</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>รายการ</th><th>จำนวน</th><th>ราคา</th><th>รวม</th>";
                echo "</tr>";
                

                $sql2 = "SELECT * FROM order_list WHERE project_name='$project_name' AND farmer_name='$farmer_name' AND order_date='".$show['order_date']."' ";
                $qry2 = $connect->query($sql2);
                while($show2 = $qry2->fetch_array()){
                    echo "<tr>";
                    echo "<td class='col-xs-6'>".$show2['product_name']."</td>";
                    echo "<td class='col-xs-2'>".$show2['number_order']."</td>";
                    echo "<td class='col-xs-2'>".number_format($show2['product_price'])."</td>";
                    echo "<td class='col-xs-2'>".number_format($show2['total_price'])."</td>";
                    $total = $show2['total_price'];
                    echo "</tr>";
                    $sumtotal += intVal($total);
                    $sumtotal2 += intVal($total);
                }
                
                echo "<tr><th colspan='3'>รวมราคา </th>";
                echo "<th >".number_format($sumtotal)."</th></tr>";
                echo "<tr><td colspan='4' style='background-color:#E5E5E5;'></td></tr>";
                $sumtotal = 0;
            }
            echo "<tr><th colspan='4' style='text-align:center;'>รวมราคาตลอดโครงการ</th></tr>";
            echo "<tr><th colspan='4' style='text-align:center;'>ทั้งหมด : <span style='color:blue;' >".number_format($sumtotal2)."</span> บาท</th></tr>";
        ?>
        </table>
</body>
</html>

<script>
$(document).ready(function() {
                //autoselect 2 row1---------------------------------------
                $('#name_row1').change(function() {
                    $.ajax({
                        type: 'POST',
                        data: {name_row1: $(this).val()},
                        url: 'select_showdata.php',
                        success: function(data) {
                            $('#com_row1').html(data);
                        }
                    });
                    return false;
                });
            });
</script>