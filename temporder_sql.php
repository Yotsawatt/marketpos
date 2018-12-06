<?php

    require('src/connect.php');

    $product_number = $_POST["product_number"];
    $product_price = $_POST["price_pd"];
    $id = $_POST["id"];
    $modeupd = $_POST["modeupd"];
    $modedel = $_GET["modedel"];
    $iddel = $_GET["iddel"];

    $lastprice = $product_number*$product_price;


    if($modeupd == 1){
        $sqlupd = "UPDATE temp_order 
        SET product_number='$product_number',product_totalprice='$lastprice'
        WHERE id = $id; ";
        if($connect->query($sqlupd)){
            header('location:main.php?barcodesearch=');
        }
    }
    if($modedel == 2){
        $sqldel = "DELETE FROM temp_order WHERE id = $iddel ";
            if($connect->query($sqldel)){
                header('location:main.php?barcodesearch=');
            }
    }
    if($modedel == 3){
        $sqltruncate = "TRUNCATE TABLE temp_order ";
            if($connect->query($sqltruncate)){
                header('location:main.php?barcodesearch=');
            }
    }

?>