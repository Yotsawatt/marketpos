<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('src/include.php') ?>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body onload='setFocusToTextBox()'>
    <?php require('src/header.php');
        require('src/connect.php');
    ?>
    
    <main><!-- main -->
        <!-- first -->
        <div class="row">
            <!-- start left col -->
            <div class="col s12 m6 ">
                <form action="main.php" method="GET">
                    <input type="text" name="barcodesearch" id="search" >
                </form>
                <?php 
                    $barcodesearch = $_GET["barcodesearch"];
                    $total_price = 0;

                    $sqlsearch = "SELECT * FROM product WHERE barcode='$barcodesearch' ";
                    $searchquery = $connect->query($sqlsearch);
                    while($row = $searchquery->fetch_array()){
                        $product_id = $row["product_id"];
                        $barcode = $row["barcode"];
                        $product_name = $row["product_name"];
                        $product_price = $row["product_price"];
                        $product_unit  = $row["product_unit"];
                        $product_category = $row["product_category"];
                        $product_number = 1;
                        $tempbarcode = "";

                        $sqlsearchtemp = "SELECT * FROM temp_order WHERE barcode='$barcodesearch'";
                        $querysearchtemp = $connect->query($sqlsearchtemp);
                        while($tempsearch = $querysearchtemp->fetch_array()){
                            $tempbarcode = $tempsearch["barcode"];
                            $temp_totalnumber = $tempsearch["product_number"];
                            $temp_price = $tempsearch["product_price"];
                            $temp_totalprice = $tempsearch["product_totalprice"];
                            // echo $tempbarcode."=".$barcodesearch;
                        }

                        
                        if($barcodesearch != $tempbarcode){
                            $inssearch = "INSERT INTO temp_order (product_id,barcode,product_name,product_number,product_unit,product_price,product_totalprice,product_category)
                            VALUES ('$product_id','$barcode','$product_name','$product_number','$product_unit','$product_price','$product_price','$product_category') ";
                            if($connect->query($inssearch)){
                                
                            }
                            // echo "ข้อมูลไม่ซ้ำ";
                        }
                        if($barcodesearch == $tempbarcode){
                            // echo "ข้อมูลซ้ำ";
                            $temp_totalnumber +=1;
                            $total_price = ($temp_price+$temp_totalprice);
                            $updatesearch = "UPDATE temp_order SET product_number='$temp_totalnumber',product_totalprice='$total_price' WHERE barcode='$barcodesearch' ";
                            if($connect->query($updatesearch)){
                                
                            }
                        }
                    
                    }

                ?>
                <table class="striped" style="font-size:14px;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ชื่อสินค้า</th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                            <th>ส่วนลด</th>
                            <th>รวม</th>
                            <th>แก้ไข/ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sqltemp = "SELECT * FROM temp_order ";
                            $querytemp = $connect->query($sqltemp);
                            $count = 1;
                            $sum_price = 0;
                            while($rowtemp = $querytemp->fetch_array()){
                                echo "<tr>";
                                echo "<td>".$count++."</td>";
                                // echo "<td>".$rowtemp['product_id']."</td>";
                                // echo "<td>".$rowtemp['barcode']."</td>";
                                echo "<td>".$rowtemp['product_name']."</td>";
                                echo "<td>".$rowtemp['product_price']."</td>";
                                echo "<td>".$rowtemp['product_number']."</td>";
                                echo "<td>".$rowtemp['discount']."</td>";
                                echo "<td>".$rowtemp['product_totalprice']."</td>";
                                echo "<td>
                                <a href='temporder_upd.php?id=".$rowtemp['id']."' class='btn btn-small blue' >แก้ไข</a>
                                <a href='temporder_sql.php?iddel=".$rowtemp['id']."&modedel=2' class='btn btn-small red'>ลบ</a></td>";
                                echo "</tr>";
                                $sum_price +=$rowtemp['product_totalprice'];
                            }
                        ?>
                    </tbody>
                </table>
                    <!-- start total -->
                    <div id="info">
                        <div class="row" >
                            <div class="col s12 m12 center-align">
                                <span class="total-text1 ">ราคารวม </span> 
                                <span class="total-text2"> <?php echo $sum_price; ?> </span>
                                <span class="total-text3">บาท</span>
                            </div>
                        </div>
                        <!-- end row 1 -->
                        <div class="row center-align">
                            <div class="col s12 m12">
                                <a href="temporder_sql.php?modedel=3" class="btn-large">เริ่มใหม่</a>
                                <a href="checkmoney.php?total=<?php echo $sum_price; ?>" class="btn-large modal-trigger ">รับเงิน (F2)</a>
                            </div>
                        </div>
                        <!-- end row 2 -->
                        </div>
                    <!-- end total -->

            </div>
            <!-- start right col -->
            <div class="col s12 m6">
                <div class="row menutexthead">
                    <div class="col s12 center-align">
                        <span class="">รายการสินค้าทั้งหมด</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                    <?php 
                        $showpro1 = "SELECT * FROM product ORDER BY product_category ASC ";
                        $queryshow1 = $connect->query($showpro1);
                        $i = 1;

                        while($show1 = $queryshow1->fetch_array()){
                            echo "<div class='col s12 m3 ' ><a href='main.php?barcodesearch=".$show1['barcode']."' class='btn btncus' >".$show1['product_name']."</a></div>";
                        }

                    ?>
                    </div>
                </div>

            </div> <!-- end right col -->
           
        </div>
        <!-- end main row -->
        
        
</main>



<script>
    function setFocusToTextBox(){
        document.getElementById("search").focus();
    }

    $(document).ready(function(){
        $('.tabs').tabs();
        $('.modal').modal();
    });



    document.onkeydown = function(){
    if(window.event && window.event.keyCode == 113) 
        {
            // alert('test');
            window.location.href="checkmoney.php?total=<?php echo $sum_price; ?>"
        }
    }
    function confirmreset(){
        var x = window.confirm(" ต้องการรีเซตคิวเพื่อเริ่มนับใหม่ ? ");
        return(x);
    }


</script>
</body>
</html>