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
        <form action="product_sql.php" method="post">
            <!-- row1 -->
            <div class="row">
                <div class="input-field col s12 m3">
                    <input type="text" name="product_id" id="product_id" class="validate" value="<?php echo $row["order_code"]; ?>" disabled >
                    <label for="product_id">รหัสการสั่ง</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="barcode" id="barcode" class="validate" value="<?php echo $row["time"]; ?>" >
                    <label for="barcode">เวลาทำรายการ</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="product_name" id="product_name" class="validate" value="<?php echo $row["product_name"]; ?>" disabled>
                    <label for="product_name">รายการสินค้า</label>
                </div>
                <div class="input-field col s12 m3">
                    <select name="category" id="category">
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
                    <input type="text" name="price" class="validate" id="price" value="<?php echo $row["product_number"]; ?>">
                    <label for="price">จำนวน</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="product_number" class="validate" id="product_number" value="<?php echo $row["product_price"]; ?>" disabled>
                    <label for="product_number">ราคา</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="unit" class="validate" id="unit" value="<?php echo $row["product_totalprice"]; ?>" disabled>
                    <label for="unit">ราคารวม</label>
                </div>
            </div>
            <!-- row3 -->
            <div class="row">
                <div class="col s12 m12 center-align">
                    <input type="submit" value="แก้ไขรายการ" class="btn btn-large">
                    <input type="hidden" name="fnc" value="2">
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