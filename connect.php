<?php
    $servername = "localhost";
    $username = "root";
    $password = "usbw";
    $database = "minilink";

    $conn = mysqli_connect($servername, $username, $password, $database);
    mysqli_set_charset($conn,"utf8");
?>