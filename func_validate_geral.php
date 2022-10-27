<?php
function validateGeral(&$response, &$request_vars){
    include ".\connect.php";

    $response['msg'] = 'Operacao bem sucedida';
    http_response_code(200); // OK

    // VALIDA ENVIO DE DADOS
    if(! isset($request_vars['idUrl'])){
        $response['msg'] = 'Dados nao inseridos';
        http_response_code(400); // Bad Request
        return 0;
    }

    // VALIDA SE OS DADOS EXISTEM
    $idUrl = $request_vars['idUrl'];
    $sql = "SELECT link_ini FROM links WHERE id='$idUrl'";
	$result = $conn->query($sql);

    if($result->num_rows==0){ 
        $response['msg'] = 'Url nao encontrada';
        http_response_code(404); // Not Found
        return 0;
    }

    // VALIDA AUTORIZAÇÃO
    $sql = "SELECT keyUsuario FROM usuario INNER JOIN links ON usuario.id = links.fk_usuario_id WHERE links.id='$idUrl'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($result->num_rows!=0 && (!isset($request_vars['key']))){
        $response['msg'] = 'Permissao insuficiente';
        http_response_code(401); // Unauthorized
        return 0;
    }
    if($result->num_rows!=0 && (isset($request_vars['key']) && $row['keyUsuario'] !== $request_vars['key'])){
        $response['msg'] = 'Permissao insuficiente';
        http_response_code(403); // Forbidden
        return 0;
    }

    return 1;
}
?>