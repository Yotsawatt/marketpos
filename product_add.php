<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('src/include.php') ?>
    <link rel="stylesheet" href="css/product.css">
</head>
<body>
    <?php require('src/header.php') ?>
    <div class="container">
        <div class="row addproduct">
        <form action="product_sql.php" method="post">
            <!-- row1 -->
            <div class="row">
                <div class="input-field col s12 m3">
                    <input type="text" name="product_id" id="product_id" class="validate">
                    <label for="product_id">รหัสสินค้า</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="barcode" id="barcode" class="validate">
                    <label for="barcode">รหัสบาร์โค้ด</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="product_name" id="product_name" class="validate">
                    <label for="product_name">ชื่อสินค้า</label>
                </div>
                <div class="input-field col s12 m3">
                    <select name="category" id="category">
                        <option value="" disabled selected>เลือกหมวดหมู่</option>
                        <option value="เครื่องดื่ม">เครื่องดื่ม</option>
                        <!-- <option value="อาหาร">อาหาร</option> -->
                        <option value="ไอศครีม">ไอศครีม</option>
                        <option value="สินค้าสำเร็จรูป">สินค้าสำเร็จรูป</option>
                    </select>

                    <!-- <input type="hidden" name="category" value="all"> -->
                </div>
            </div>
            <!-- row2 -->
            <div class="row">
                <div class="input-field col s12 m3">
                    <input type="text" name="price" class="validate" id="price">
                    <label for="price">ราคา</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="product_number" class="validate" id="product_number">
                    <label for="product_number">จำนวน</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="unit" class="validate" id="unit">
                    <label for="unit">หน่วย</label>
                </div>
            </div>
            <!-- row3 -->
            <div class="row">
                <div class="col s12 m12 center-align">
                    <input type="submit" value="เพิ่มสินค้า" class="btn btn-large">
                    <input type="hidden" name="fnc" value="1">
                    <a href="product.php" class="btn red btn-large">ยกเลิก</a>
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