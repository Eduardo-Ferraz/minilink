<?php
include ".\\func_validate_geral.php";
include ".\\func_validate_id.php";
include ".\\func_gerar_id_rand.php";
include ".\connect.php";

$response = array();
$request_vars = $_POST;

if(validateGeral($response, $request_vars)){
    if(! isset($request_vars['novaIdUrl'])){
        $novaIdUrl = gerarIdRand();
    }
    if(validateIdUrl($response, $request_vars)){
        $idUrl = $request_vars['idUrl'];
        $novaIdUrl = $request_vars['novaIdUrl'];
        $sql = "UPDATE links SET links.id='$novaIdUrl' WHERE links.id='$idUrl'";
        $conn->query($sql);
        $conn->commit();
        $response['novaIdUrl'] = $novaIdUrl;
    }
}

echo json_encode($response);
$conn->close();
?>