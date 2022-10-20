<?php
$response['success'] = 0;

switch($errorMsg){
    case 0:
        $conn->query($sql);
        $conn->commit();
        $response['msg'] = 'Operacao bem sucedida';
        $response['id'] = $idUrl;
        $response['success'] = 200;
        break;
    case 1:
        $response['msg'] = 'Dados nao inseridos';
        $response['success'] = 204; // Nenhum conteúdo
        break;
    case 2:
        $response['msg'] = 'Permissao insuficiente';
        $response['success'] = 401; // Não autorizado
        break;
    case 3:
        $response['msg'] = 'idUrl ja existente, informe outra';
        $response['success'] = 406; // Não aceito
        break;
    case 4:
        $response['msg'] = 'Url nao encontrada';
        $response['success'] = 400; // Solicitação inválida
        break;
    default:
        $response['msg'] = 'Erro desconhecido';
        $response["success"] = 404; // Não encontrado
        break;
}

echo json_encode($response);
?>