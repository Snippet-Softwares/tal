<?php
    require('conn.php');
    if(isset($_GET['q'])) {
        date_default_timezone_set('Africa/Nairobi');
        $datetime = date("Y-m-d H:i:s");
        $date = date("Y-m-d",strtotime($datetime));
        $time = date("H:i:s",strtotime($datetime));
        $vol = $_GET['q'];
        mysqli_query($conn,"insert into levels (vol) values ('".$vol."')") or die(mysqli_error($conn));
        echo "successfull";
    }
    else {
        echo "Failed";
    }
?>