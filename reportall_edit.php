<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('src/include.php') ?>
    <link rel="stylesheet" href="css/product.css">
</head>
<body>
    <?php require('src/header.php');

        require('src/connect.php');
        $id = $_GET["id"];
        $sqlshow = "SELECT * FROM orderall WHERE id ='$id' ";
        $showquery = $connect->query($sqlshow);
        $row = $showquery->fetch_array();

    ?>
    <div class="container">
        <div class="row addproduct">
        <form action="reportall_sql.php" method="GET">
            <!-- row1 -->
            <div class="row">
                <div class="input-field col s12 m3">
                    <input type="text" name="order_code" id="order_code" class="validate" value="<?php echo $row["order_code"]; ?>" disabled >
                    <label for="order_code">รหัสการสั่ง</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="time" id="time" class="validate" value="<?php echo $row["timeorder"]; ?>" >
                    <label for="time">เวลาทำรายการ</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="product_name" id="product_name" class="validate" value="<?php echo $row["product_name"]; ?>" disabled>
                    <label for="product_name">รายการสินค้า</label>
                </div>
                <div class="input-field col s12 m3">
                    <select name="category" id="category" disabled>
                        <option value="<?php echo $row["product_category"]; ?>" ><?php echo $row["product_category"]; ?></option>
                        <option value="เครื่องดื่ม">เครื่องดื่ม</option>
                        <!-- <option value="อาหาร">อาหาร</option> -->
                        <option value="ไอศครีม">ไอศครีม</option>
                        <option value="สินค้าสำเร็จรูป">สินค้าสำเร็จรูป</option>
                    </select>
                    <label>หมวดหมู่</label>
                </div>
            </div>
            <!-- row2 -->
            <div class="row">
                <div class="input-field col s12 m3">
                    <input type="text" name="product_number" class="validate" id="product_number" value="<?php echo $row["product_number"]; ?>">
                    <label for="product_number">จำนวน</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="price" class="validate" id="price" value="<?php echo $row["product_price"]; ?>" disabled>
                    <label for="price">ราคา</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="discount" class="validate" id="discount" value="<?php echo $row["discount"]; ?>">
                    <label for="discount">ส่วนลด</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="product_totalprice" class="validate" id="product_totalprice" value="<?php echo $row["product_totalprice"]; ?>" disabled>
                    <label for="product_totalprice">ราคารวม</label>
                </div>
            </div>
            <!-- row3 -->
            <div class="row">
                <div class="col s12 m12 center-align">
                    <input type="submit" value="แก้ไขรายการ" class="btn btn-large">
                    <input type="hidden" name="old_price" value="<?php echo $row["product_price"]; ?>">
                    <input type="hidden" name="mode" value="1">
                    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                    <a href="reportall.php" class="btn red btn-large">ยกเลิก</a>
                </div>
            </div>
        </form>
        </div>
    </div>
<script>
    $(document).ready(function(){
        $('select').formSelect();
    });
</script>
</body>
</html>