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
    ?>
    <div class="container">
        <div class="row phead">
            <div class="col s12 m12">
                <p class="center-align texthead">รายงานการขายสินค้าทั้งหมด</p>
            </div>
        </div>
        <!-- show data table -->
        <div class="row ">
            <div class="col s12 m12">
            <table class="striped responsive-table centered" >
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รหัสการสั่ง</th>
                        <th>หมวดหมู่</th>
                        <th>รายการสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                        <th>ส่วนลด</th>
                        <th>ราคารวม</th>
                        <th>วันที่ทำรายการ</th>
                        <th>แก้ไข/ลบ</th>
                    </tr>
                </thead>
                <?php 
                    $sqlshow = "SELECT * FROM orderall ORDER BY id DESC ";
                    $showquery = $connect->query($sqlshow);
                    $count = 1;
                    while($row = $showquery->fetch_array()){
                       if($row["order_code"] != ''){
                            echo "<tr>";
                            echo "<td>".$count++."</td>";
                            echo "<td>".$row['order_code']."</td>";
                            echo "<td>".$row['product_category']."</td>";//wait
                            echo "<td>".$row['product_name']."</td>";
                            echo "<td>".$row['product_number']."</td>";
                            echo "<td>".$row['product_price']."</td>";
                            echo "<td>".$row['discount']."</td>";
                            echo "<td>".$row['product_totalprice']."</td>";
                            echo "<td>".$row['timeorder']."</td>";
                            echo "<td><a href='reportall_edit.php?id=".$row['id']." ' class='btn blue'>แก้ไข</a>
                            <a href='reportall_sql.php?id=".$row['id']."&mode=2 ' class='btn red' onclick='return confirmm()'>ลบ</a></td>";
                            echo "</tr>";
                       }
                    }
                ?>
            </table>
            </div>
        </div>
    </div>
<script>
    function confirmm(){
        var x = window.confirm("คุณต้องการลบข้อมูลหรือไม่ ?");
        return(x);
    }
</script>
</body>
</html>