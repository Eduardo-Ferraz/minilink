<?php

include ".\connect.php";
$new_url = "";

if(isset($_POST["link"])){
    $new_url = $_POST["link"];
    echo '<p>O link encurtado é $new_url</p>';
}

?>