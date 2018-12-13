<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('src/include.php') ?>
    <link rel="stylesheet" href="css/product.css">
</head>
<body>
    <?php 
        require('src/header.php');
        //require('src/connect.php'); 
        // $ordertime = $_GET['ordertime'];
        $begintime = $_GET["begintime"];
        $lasttime = $_GET["lasttime"];
    ?>
    <div class="container">
        <div class="row phead">
            <div class="col s12 m12">
                <p class="center-align texthead">รายงานการขายสินค้าประจำวัน</p>
            </div>
        </div>
        <div class="row">
            <form action="reportinday.php" method="GET">
                <div class="col s12 m5">
                    <span style="font-size:16px;">รายการประจำวันที่ : <?php echo date('d-m-Y',strtotime($begintime)); ?> ถึงวันที่ : <?php echo date('d-m-Y',strtotime($lasttime)); ?> </span>
                </div>
                <div class="col s12 m2">
                    <input type="date" id="begintime" name="begintime" value="<?php echo date('y-m-d') ?>">
                    <label for="begintime">เลือกวันที่</label>
                </div>
                <div class="col s12 m2">
                    <input type="date" id="lasttime" name="lasttime" value="<?php echo date('y-m-d') ?>">
                    <label for="lasttime">ถึงวันที่</label>
                </div>
                <div class="col s12 m3">
                    <input type="submit" class="btn blue" value="ต้นหา">
                    <a href="pdfinday.php?begintime=<?php echo $begintime; ?>&lasttime=<?php echo $lasttime; ?>" class="btn red darken-2" target="_blank" >ปริ้นรายงาน</a>
                </div>
            </form>
        </div>

        <!-- show data table -->
        <div class="row ">
            <div class="col s12 m12">
            <!-- table 1 ไอศครีม -->
            <table class="striped responsive-table centered " >
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <!-- <th>รหัสการสั่ง</th> -->
                        <th>หมวดหมู่</th>
                        <th>รายการสินค้า</th>
                        <th>จำนวน</th>
                        <th>ส่วนลด</th>
                        <th>ราคา</th>
                        <th>ราคารวม</th>
                    </tr>
                </thead>
                <?php 
                    $sqlcatagory = "SELECT product_category FROM orderall GROUP BY product_category  ";
                    $categoryquery = $connect->query($sqlcatagory);
                    $sum_priceall = 0;
                    $sum_numberall = 0;
                    while($cate = $categoryquery->fetch_array()){

                        $catehead = $cate["product_category"];


                        $sqlshow = "SELECT *,SUM(product_number) AS product_number, SUM(product_totalprice) AS product_total,SUM(discount) AS discount
                        FROM orderall WHERE DATE(timeorder) >='$begintime' AND DATE(timeorder) <='$lasttime'  AND product_category='$catehead' GROUP BY product_name";
                        $showquery = $connect->query($sqlshow);
                        $count = 1;
                        $sum_number = 0;
                        $sum_price = 0;
                        while($row = $showquery->fetch_array()){
                            if($row["order_code"] != ''){
                                    echo "<tr>";
                                    echo "<td>".$count++."</td>";
                                    // echo "<td>".$row['order_code']."</td>";
                                    echo "<td>".$row['product_category']."</td>";//wait
                                    echo "<td>".$row['product_name']."</td>";
                                    echo "<td>".$row['product_number']."</td>";
                                    echo "<td>".$row['discount']."</td>";
                                    echo "<td>".$row['product_price']."</td>";
                                    echo "<td>".$row['product_total']."</td>";
                                    echo "</tr>";
                                    $sum_number += $row['product_number'];
                                    $sum_numberall += $row['product_number'];
                                    $sum_price += $row['product_total'];
                                    $sum_priceall += $row['product_total'];  
                                    
                            }
                        }
                        echo "<tr>";
                        echo "<td colspan='3' ><p class='text-sum right-align'>สรุปรายการ ".$cate["product_category"]." ทั้งหมด</p></td>";
                        echo "<td><span class='text-sum'>".$sum_number."</span></td>";
                        echo "<td colspan='2'></td>";
                        echo "<td ><span class='text-sum'>".$sum_price."</span></td>";
                        // echo "<td></td>";
                        echo "</tr>";
                    }
                    echo "<tr>";
                    echo "<td colspan='3'><p class='text-sum right-align'>รวมทั้งหมด</p></td>";
                    echo "<td><span class='text-sum'>".$sum_numberall."</span></td>";
                    echo "<td colspan='2'></td>";
                    echo "<td ><span class='text-sum'>".$sum_priceall."</span></td>";
                    // echo "<td></td>";
                    echo "</tr>";

                ?>
            </table>
            
            </div>
        </div>
    </div>

</body>
</html>