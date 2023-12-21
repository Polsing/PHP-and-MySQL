<?php

    $hostname = "apl-ps.trueddns.com";
    $username = "apl01";
    $password = "apl.server01";
    $database = "myprojace";
    $port = 49591;

    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = mysqli_connect($hostname , $username , $password , $database , $port);
    if(!$conn){
        die("connection_error: ".mysqli_connect_errno());
    }

    
?>