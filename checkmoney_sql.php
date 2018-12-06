<?php 

    require('src/connect.php');

    $sumchange = $_POST["sumchange"];
    $total = $_POST["total"];
    $moneyin = $_POST["moneyin"];
    
    // generate order code
    $gensql2 = "SELECT MAX(order_code) AS order_code FROM orderall";
    $qry2 = $connect->query($gensql2);
    $genrow2 = $qry2->fetch_assoc();
    $maxId2 = substr($genrow2['order_code'],-5);
    $maxId2 += 1;
    $maxId2 = substr("00000".$maxId2,-5);
    $order_code = $maxId2;

    // generate queue
    $genq = "SELECT queueorder FROM orderall ORDER BY id DESC LIMIT 1";
    $qry3 = $connect->query($genq);
    $genrow3 = $qry3->fetch_assoc();
    $maxId3 = substr($genrow3['queueorder'],-3);
    $maxId3 += 1;
    $maxId3 = substr("000".$maxId3,-3);
    $queueorder = $maxId3;

    echo $genrow3['queueorder']."<br>".$queueorder;

    // echo $sum."<br>".$total."<br>".$moneyin;
    $new_number = 0;
    $showtemp = "SELECT * FROM temp_order";
    $showtempquery = $connect->query($showtemp);
    while($rowtemp = $showtempquery->fetch_array()){
        $product_id = $rowtemp["product_id"];
        $barcode = $rowtemp["barcode"];
        $product_name = $rowtemp["product_name"];
        $product_number = $rowtemp["product_number"];
        $product_unit = $rowtemp["product_unit"];
        $product_price = $rowtemp["product_price"];
        $product_totalprice = $rowtemp["product_totalprice"];
        $product_category = $rowtemp["product_category"];

        $sqlinsert = "INSERT INTO orderall (order_code,product_id,barcode,product_name,product_number,product_unit,product_price,product_totalprice,total_price,moneyin,sumchange,queueorder,product_category)
        VALUES ('$order_code','$product_id','$barcode','$product_name','$product_number','$product_unit','$product_price','$product_totalprice','$total','$moneyin','$sumchange','$queueorder','$product_category')";
        if($connect->query($sqlinsert)){

            $selpro = "SELECT * FROM product WHERE product_id = $product_id";
            $selproquery = $connect->query($selpro);
            $selproduct = $selproquery->fetch_array();
            $old_number = $selproduct["product_number"];
            $new_number = $old_number-$product_number;

            $sqlup = "UPDATE product SET product_number='$new_number' WHERE product_id = $product_id ";
            $connect->query($sqlup);
        }

    }
    $sqldel = "TRUNCATE TABLE temp_order";
    if($connect->query($sqldel)){
        
        header("location:pdfprint.php?order_code=$order_code");
        header("location:main.php?barcodesearch=");
    }


?>