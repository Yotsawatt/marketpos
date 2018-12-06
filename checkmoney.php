<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('src/include.php'); ?>
    <link rel="stylesheet" href="css/checkmoney.css">
</head>
<body onload="focusmoney()">
    <?php 
        require('src/header.php'); 
        require('src/connect.php');

        $total = $_GET["total"];

    ?>
    <div class="container">
        <form name="form" in="form" action="checkmoney_sql.php" method="POST">
            <div class="row">
                <div class="col s12 m6 right-align">
                    <span class="textmoney">รับเงิน : </span>
                </div>
                <div class="col s12 m6">
                    <input type="text" name="moneyin" id="moneyin" onkeyup="calculateBMI()" style="height:100px;font-size:50px;" >
                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                </div>
            </div>
            <!-- end row1 -->
            <div class="row">
                <div class="col s12 m6 right-align">
                    <span class="textmoney" >ราคารวมทั้งหมด : </span>
                </div>
                <div class="col s12 m6">
                    <input type="text" value="<?php echo $total; ?>" style="height:100px;font-size:50px;" >
                </div>
            </div>
            <!-- end row2 -->
            <div class="row">
                <div class="col s12 m6 right-align">
                    <span class="textmoney " >เงินทอน : </span>
                </div>
                <div class="col s12 m6">
                    <input type="text" name="sumchange" id="sumchange" style="height:100px;font-size:50px;">
                </div>
            </div>
            <!-- end row2 -->
            <div class="row">
                <div class="col s12 m12 center-align">
                    <input type="submit" class="btn btn-large" value="บันทึก">
                    <a href="main.php?barcodesearch=" class="btn btn-large red">ยกเลิก</a>
                </div>
            </div>
        </form>
    </div>
<script>
    function focusmoney(){
        document.getElementById("moneyin").focus();
    }

    function calculateBMI() {
        var wtStr =document.form.moneyin.value;
        if (!wtStr)
            wtStr = '0';
        var htStr = document.form.total.value;
        if (!htStr)
            htStr = '0';
        var moneyin = parseFloat(wtStr);
        var total = parseFloat(htStr);
        document.form.sumchange.value = moneyin - total;
    }

</script>


</body>
</html>