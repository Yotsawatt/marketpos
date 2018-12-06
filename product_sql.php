<?php 

require('src/connect.php');


$fnc2 = $_GET["fnc2"];
$iddel = $_GET["iddel"];

$id = $_POST["id"];
$fnc = $_POST["fnc"];
$product_id = $_POST["product_id"];
$barcode = $_POST["barcode"];
$product_name = $_POST["product_name"];
$price = $_POST["price"];
$product_number = $_POST["product_number"];
$unit = $_POST["unit"];
$category = $_POST["category"];

// insert to database
if ($fnc == 1){

    $sqlinsert = "INSERT INTO product (product_id,barcode,product_name,product_price,product_number,product_unit,product_category) 
    VALUES ('$product_id','$barcode','$product_name','$price','$product_number','$unit','$category')";

    if($queryinsert = $connect->query($sqlinsert)){
        header('location:product.php');
    }
}
// update database
if($fnc == 2){
    $sqlupdate = "UPDATE product 
    SET product_id='$product_id',barcode='$barcode',product_name='$product_name',product_price='$price',product_number='$product_number',product_unit='$unit',product_category='$category' 
    WHERE id = $id ";

    if($connect->query($sqlupdate)){
        header('location:product.php');
    }
}
// delete data
if($fnc2 == 3){
    $sqldel = "DELETE FROM product WHERE id = $iddel ";
    if($connect->query($sqldel)){
        header('location:product.php');
    }
}


?>