<?php
    date_default_timezone_set("Asia/Bangkok");
    include "connect.php";
    $showq = "SELECT queueorder FROM orderall ORDER BY id DESC";
    $queryq = $connect->query($showq);
    $rowq = $queryq->fetch_array();
?>
<nav class="green">
    <div class="container">
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo center">POS</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="left hide-on-med-and-down">
                <li><a href="./main.php?barcodesearch=">ขายสินค้า</a></li>
                <li><a href="./product.php">รายการสินค้า</a></li>
                <li><a href="./reportall.php">รายงานทั้งหมด</a></li>
                <li><a href="./reportinday.php?begintime=<?php echo date('Y-m-d'); ?>&lasttime=<?php echo date('Y-m-d'); ?> ">รายงานประจำวัน</a></li>
            </ul>
            
            <ul class="right hide-on-med-and-down">
                <li><span> ออเดอร์รวมทั้งหมด : <?php echo $rowq["queueorder"]; ?></span></li>
                <li><a href="./resetqueue.php" class="btn yellow black-text btn-small" onclick="return confirmreset()" >รีเซตออเดอร์</a></li>
            </ul>
        </div>
    </div>
</nav>




<ul class="sidenav" id="mobile-demo">
    <li><a href="./main.php?barcodesearch=">ขายสินค้า</a></li>
    <li><a href="./product.php">รายการสินค้า</a></li>
    <li><a href="./reportall.php">รายงานทั้งหมด</a></li>
    <li><a href="./reportinday.php?ordertime=<?php echo date('Y-m-d'); ?>">รายงานประจำวัน</a></li>
</ul>


<script>
    $(document).ready(function(){
        $('.sidenav').sidenav();
        $('.dropdown-trigger').dropdown();
    });
    
     
</script>