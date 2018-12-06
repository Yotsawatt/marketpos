<?php 

// mode= 1 edit
// mode = 2 delete
require('src/connect.php');


$id = $_GET["id"];
$mode = $_GET["mode"];
$old_price = $_GET["old_price"];
$product_number = $_GET["product_number"];
$timeorder = $_GET["time"];

if($mode==1){
    $new_totalprice = $old_price * $product_number;
    // echo $new_totalprice;
    $editsql = "UPDATE orderall SET product_number='$product_number',product_totalprice='$new_totalprice',timeorder='$timeorder' WHERE id='$id' ";
    if($editquery = $connect->query($editsql)){
        header('location:reportall.php');
    }
}

if($mode==2){
    
    $delsql = "DELETE FROM orderall WHERE id='$id' ";
    if($delquery = $connect->query($delsql)){
        header('location:reportall.php');
    }
    
}


?>