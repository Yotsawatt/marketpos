<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('src/include.php') ?>
</head>
<body>
    <?php require('src/header.php');

    require('src/connect.php');
    $id = $_GET["id"];
    $sqlshow = "SELECT * FROM temp_order WHERE id ='$id' ";
    $showquery = $connect->query($sqlshow);
    $row = $showquery->fetch_array();

    ?>
    
    <div class="container">
        <div class="row">
            <div class="col s12 m6">
                <span>แก้ไขรายการสินค้า</span>
            </div>
        </div>
        <form action="temporder_sql.php" method="post">
            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="text" id="product_name" value="<?php echo $row["product_name"]; ?>" disabled>
                    <label for="product_name">รายการสินค้า</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" id="product_price" value="<?php echo $row["product_price"]; ?>" disabled>
                    <label for="product_price">ราคา</label>
                </div>
                <div class="input-field col s12 m3">
                <input type="text" name="product_totalprice" id="product_totalprice" value="<?php echo $row["product_totalprice"]; ?>" disabled>
                    <label for="product_totalprice">ราคารวม</label>
                </div>
            </div>
            <!-- end row1 -->
            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="text" name="product_number" id="product_number" value="<?php echo $row["product_number"]; ?>">
                    <label for="product_number">จำนวนสินค้า</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="discount" id="discount" value="<?php echo $row["discount"]; ?>">
                    <label for="discount">ส่วนลด</label>
                </div>
            </div>
            <!-- end row2 -->
            <div class="row">
                <div class="col s12 m12 center-align">
                    <input type="hidden" name="price_pd" value="<?php echo $row["product_price"]; ?>">
                    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                    <input type="hidden" name="modeupd" value="1">
                    <input type="submit" value="แก้ไขรายการ" class="btn btn-large">
                    <a href="main.php?barcodesearch=" class="btn red btn-large">ยกเลิก</a>
                </div>
            </div>
            <!-- end row3 -->
        </form>
    </div>
</body>
</html>