<?php
$response['success'] = 0;

switch($errorMsg){
    case 0:
        $conn->query($sql);
        $conn->commit();
        $response['msg'] = 'Operacao bem sucedida';
        $response['id'] = $idUrl;
        $response['success'] = 1;
        break;
    case 1:
        $response['msg'] = 'Dados nao inseridos';
        $response['success'] = 2;
        break;
    case 2:
        $response['msg'] = 'Permissao insuficiente';
        $response['success'] = 3;
        break;
    case 3:
        $response['msg'] = 'idUrl ja existente, informe outra';
        $response['success'] = 4;
        break;
    case 4:
        $response['msg'] = 'Url nao encontrada';
        $response['success'] = 5;
        break;
    default:
        $response['msg'] = 'Erro desconhecido';
        $response["success"] = 6;
        break;
}

echo json_encode($response);
?>