<?php
function validateInicial(&$response, &$request_vars){
    include ".\connect.php";

    $response['msg'] = 'Operacao bem sucedida';
    $response['success'] = 200;

    // VALIDA ENVIO DE DADOS
    if(! isset($request_vars['idUrl'])){
        $response['msg'] = 'Dados nao inseridos';
        $response['success'] = 204; // Nenhum conteúdo
        return 0;
    }

    // VALIDA SE OS DADOS EXISTEM
    $idUrl = $request_vars['idUrl'];
    $sql = "SELECT link_ini FROM links WHERE id='$idUrl'";
	$result = $conn->query($sql);
    $row = $result->fetch_assoc(); // Isso é utilizado?????????

    if($result->num_rows==0){ 
        $response['msg'] = 'Url nao encontrada';
        $response['success'] = 400; // Solicitação inválida
        return 0;
    }

    // VALIDA AUTORIZAÇÃO
    $sql = "SELECT keyUsuario FROM usuario INNER JOIN links ON usuario.id = links.fk_usuario_id WHERE links.id='$idUrl'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($result->num_rows!=0 && ((!isset($request_vars['key'])) || (isset($request_vars['key']) && $row['keyUsuario'] !== $request_vars['key']))){
        $response['msg'] = 'Permissao insuficiente';
        $response['success'] = 401; // Não autorizado
        return 0;
    }

    return 1;
}

function validateIdUrl(&$response, &$request_vars){
    include ".\connect.php";

    $novaIdUrl = $request_vars['novaIdUrl'];
    $sql = "SELECT * FROM links WHERE links.id='$novaIdUrl'";
    $result = $conn->query($sql);

    if($result->num_rows!=0){
        $response['msg'] = 'idUrl ja existente, informe outra';
        $response['success'] = 406; // Não aceito
        return 0;
    }
    if(strlen($novaIdUrl) > 10 || strlen($novaIdUrl) == 0){
        $response['msg'] = 'id de tamanho invalido';
        $response['success'] = 400; // Solicitação inválida
        return 0;
    }
    
    return 1;
}

include ".\\func_gerar_id_rand.php";
include ".\connect.php";

$response = array();
$request_vars = $_POST;

if(validateInicial($response, $request_vars)){
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