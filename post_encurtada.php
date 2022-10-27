<?php
function validateEnvio(&$response, &$request_vars){
    include ".\connect.php";

    $response['msg'] = 'Operacao bem sucedida';
    http_response_code(201); // Created

    // VALIDA ENVIO DE DADOS
    if(! isset($request_vars['link'])){
        $response['msg'] = 'Dados nao inseridos';
        http_response_code(400); // Bad Request
        return 0;
    }

    return 1;
}

function validateAut(&$response, &$request_vars){
    include ".\connect.php";

    // VALIDA AUTORIZAÇÃO
    $sql = "SELECT id FROM usuario WHERE keyUsuario='{$request_vars['key']}'";
    $result = $conn->query($sql);

    if($result->num_rows==0){
        $response['msg'] = 'Permissao insuficiente';
        http_response_code(403); // Forbidden
        return 0;
    }

    $row = $result->fetch_assoc();
    $idUsuario = $row['id'];
    return $idUsuario;
}

include ".\\func_validate_id.php";
include ".\\func_gerar_id_rand.php";
include ".\connect.php";

$response = array();
$request_vars = $_POST;

if(validateEnvio($response, $request_vars)){
    $urlSite = $request_vars['link'];
    if(isset($request_vars['novaIdUrl'])){
        $novaIdUrl = $request_vars['novaIdUrl'];
        $checkIdUrl = validateIdUrl($response, $request_vars);
    }else{
        $novaIdUrl = gerarIdRand();
        $checkIdUrl = 1;
    }
    
    if($checkIdUrl){
        if(isset($request_vars['key'])){
            if($idUsuario = validateAut($response, $request_vars) != 0){
                $response['id'] = $novaIdUrl;
                $sql = "INSERT INTO links(link_ini, id, fk_usuario_id) VALUES ('$urlSite', '$novaIdUrl', $idUsuario);";
                $conn->query($sql);
                $conn->commit();
            }
        }else{
            $response['id'] = $novaIdUrl;
            $sql = "INSERT INTO links(link_ini, id) VALUES ('$urlSite', '$novaIdUrl');";
            $conn->query($sql);
            $conn->commit();
        }
    }
}

$response['responseCode'] = http_response_code();
echo json_encode($response);
$conn->close();
?>