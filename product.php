<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('src/include.php') ?>
    <link rel="stylesheet" href="css/product.css">
</head>
<body>
    <?php 
        require('src/header.php');
        require('src/connect.php'); 
    ?>
    <div class="container">
        <div class="row phead">
            <div class="col s12 m6">
                <p class="left-align texthead">รายการสินค้า</p>
            </div>
            <div class="col s12 m6 right">
                <div class="right-align"><a href="product_add.php" class="btn" >เพิ่มรายการสินค้า</a></div>
            </div>
        </div>
        <!-- show data table -->
        <div class="row ">
            <div class="col s12 m12">
            <table class="striped responsive-table centered" >
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รหัสสินค้า</th>
                        <th>หมวดหมู่</th>
                        <th>ชื่อสินค้า</th>
                        <th>รหัสบาร์โค้ด</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>หน่วย</th>
                        <th>รายละเอียด</th>
                    </tr>
                </thead>
                <?php 
                    $sqlshow = "SELECT * FROM product ORDER BY product_id ASC ";
                    $showquery = $connect->query($sqlshow);
                    $count = 1;
                    while($row = $showquery->fetch_array()){
                        echo "<tr>";
                        echo "<td>".$count++."</td>";
                        echo "<td>".$row['product_id']."</td>";
                        echo "<td>".$row['product_category']."</td>";
                        echo "<td>".$row['product_name']."</td>";
                        echo "<td>".$row['barcode']."</td>";
                        echo "<td>".$row['product_price']."</td>";
                        echo "<td>".$row['product_number']."</td>";
                        echo "<td>".$row['product_unit']."</td>";
                        echo "<td>
                        <a href='product_upd.php?id=".$row['id']."' class='btn btn-small ' >แก้ไขข้อมูล</a>
                        <a href='product_sql.php?iddel=".$row['id']."&fnc2=3 ' class='btn btn-small red  ' onclick='return confirmm()' >ลบ</a></td>";
                        echo "</tr>";
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