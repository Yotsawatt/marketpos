<?php 

// mode= 1 edit
// mode = 2 delete
require('src/connect.php');
$id = $_GET["id"];
$mode = $_GET["mode"];

if($mode==2){
    $delsql = "DELETE FROM orderall WHERE id='$id' ";
    if($delquery = $connect->query($delsql)){
        header('location:reportall.php');
    }
    
}

?>