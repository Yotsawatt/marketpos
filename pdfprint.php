<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/print.css">
</head>
<body onload="firstprint()">
<!-- <body> -->
        <?php 
            require('src/connect.php');
            $order_code = $_GET["order_code"];
            // echo $order_code;
            $select_show = "SELECT * FROM orderall WHERE order_code = $order_code";
            $showquery = $connect->query($select_show);
            $row = $showquery->fetch_array();
            

        ?>
    <table class="tableprint" border="0">
        <tr>
            <td colspan="4" class="text-center">ไร่สันสลี</td>
        </tr>
        <tr>
            <td colspan="4" class="text-center">ใบเสร็จรับเงิน</td>
        </tr>
        <tr>
            <td class="sizeproduct" >เลขที่ใบเสร็จ : <?php echo $row["order_code"]; ?></td>
        </tr>
        <tr>
            <td  class="sizeproduct" >วันที่ : <?php echo $row["time"]; ?></td>
        </tr>
        <tr class="sechead">
            <th>รายการ</th>
            <th>จำนวน</th>
            <th>ราคา</th>
            <th>รวม</th>
        </tr>
        <?php 

            $select_show2 = "SELECT * FROM orderall WHERE order_code = $order_code";
            $showquery2 = $connect->query($select_show2);
            while($row2 = $showquery2->fetch_array()){

                echo "<tr class='sizeproduct'>";
                echo "<td width='65%'>".$row2['product_name']."</td>";
                echo "<td width='15%'>".$row2['product_number']."</td>";
                echo "<td width='10%'>".$row2['product_price']."</td>";
                echo "<td width='10%'>".$row2['product_totalprice']."</td>";
                echo "</tr>";
            }
            echo "<tr class='sizeproduct'>";
            echo "<th colspan='3'>รวมราคา</th>";
            echo "<td  >".$row['total_price']."</td>";
            echo "</tr>";
            echo "<tr class='sizeproduct'>";
            echo "<th colspan='3'>รับเงินมา</th>";
            echo "<td >".$row['moneyin']."</td>";
            echo "</tr>";
            echo "<tr class='sizeproduct'>";
            echo "<th colspan='3'>เงินทอน</th>";
            echo "<td>".$row['sumchange']."</td>";
            echo "</tr>";
            echo "<tr class='sizeproduct'>";
            echo "<th colspan='4' class='text-center'><span class='queueorder'>คิวที่ : ".$row["queueorder"]."</span></th>";
            echo "</tr>";
        ?>

        <tr class="sizeproduct text-center">
            <td colspan="4">WIFI SSID : SANSALI</td>
        </tr>
        <tr class="sizeproduct text-center">
            <td colspan="4">PASSWORD : sansali</td>
        </tr>
        <tr class="sizeproduct text-center">
            <td colspan="4"><span>ไร่สันสลี 333 หมู่ 5 บ้านสันสลี ต.สันสลี อ.เวียงป่าเป้า จ.เชียงราย 57170 , โทร : 08X-XXXXXXX</span></td>
        </tr>
    </table>

<script>

    function firstprint(){
        window.print();
        setTimeout("secondprint()",500);
    }
    function secondprint(){
        window.print();
        setTimeout("closeprint()",500);
    }
    function closeprint(){

        document.location.href = 'main.php?barcodesearch=';
    }

</script>
</body>
</html>