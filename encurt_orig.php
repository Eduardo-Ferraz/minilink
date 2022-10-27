<?php
include ".\\func_validate_geral.php";
include ".\connect.php";

$response = array();
$request_vars = $_GET;

if(validateGeral($response, $request_vars)){
    $idUrl = $request_vars['idUrl'];
    $sql = "SELECT link_ini FROM links WHERE id='$idUrl'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $response['link'] =  $row['link_ini'];
}

$response['responseCode'] = http_response_code();
echo json_encode($response);
$conn->close();
?>