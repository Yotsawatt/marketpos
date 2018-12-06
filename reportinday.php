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
        $ordertime = $_GET['ordertime'];
    ?>
    <div class="container">
        <div class="row phead">
            <div class="col s12 m12">
                <p class="center-align texthead">รายงานการขายสินค้าประจำวัน</p>
            </div>
        </div>
        <div class="row">
            <form action="reportinday.php" method="GET">
                <div class="col s12 m6">
                    <span class="texthead">รายการประจำวันที่ : <?php echo date('d-m-Y',strtotime($ordertime)); ?></span>
                </div>
                <div class="col s12 m3">
                    <input type="date" id="ordertime" name="ordertime" value="<?php echo date('y-m-d') ?>">
                    <label for="ordertime">เลือกวันที่</label>
                </div>
                <div class="col s12 m3">
                    <input type="submit" class="btn blue" value="ต้นหา">
                    <a href="pdfinday.php?ordertime=<?php echo $ordertime; ?> " class="btn red darken-2" target="_blank" >ปริ้นรายงาน</a>
                </div>
            </form>
        </div>

        <!-- show data table -->
        <div class="row ">
            <div class="col s12 m12">
            <table class="striped responsive-table centered " >
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <!-- <th>รหัสการสั่ง</th> -->
                        <th>หมวดหมู่</th>
                        <th>รายการสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                        <th>ราคารวม</th>
                    </tr>
                </thead>
                <?php 
                    $sqlshow = "SELECT *,SUM(product_number) AS product_number, SUM(product_totalprice) AS product_total
                    FROM orderall WHERE DATE(timeorder)='$ordertime' GROUP BY product_name";
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
                            echo "<td>".$row['product_price']."</td>";
                            echo "<td>".$row['product_total']."</td>";
                            echo "</tr>";
                            $sum_number += $row['product_number'];
                            $sum_price += $row['product_total']; 
                       }
                    }
                    echo "<tr>";
                    echo "<td colspan='3'><p class='text-sum'>สรุปรายการซื้อสินค้าทั้งหมด</p></td>";
                    echo "<td><span class='text-sum'>".$sum_number."</span></td>";
                    echo "<td></td>";
                    echo "<td colspan='2'><span class='text-sum'>".$sum_price."</span></td>";
                    echo "<td></td>";
                    echo "</tr>";
                ?>
            </table>
            </div>
        </div>
    </div>

</body>
</html>