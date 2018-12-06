<?php 
    require('src/connect.php');
    $reset  = "INSERT INTO orderall (queueorder,product_name) VALUES ('000','Reset_queue')";
    if($resetq = $connect->query($reset)){
        header('location:main.php?barcodesearch=');
    }

?>