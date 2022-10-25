<?php
function validate(&$response, &$request_vars){
    include ".\connect.php";

    $response['msg'] = 'Operacao bem sucedida';
    $response['success'] = 200;

    // VALIDA ENVIO DE DADOS
    if(! isset($request_vars['link'])){
        $response['msg'] = 'Dados nao inseridos';
        $response['success'] = 204; // Nenhum conteúdo
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
        $response['success'] = 401; // Não autorizado
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

if(validate($response, $request_vars)){
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

echo json_encode($response);
$conn->close(); // No final do arquivo, certo?????
?>