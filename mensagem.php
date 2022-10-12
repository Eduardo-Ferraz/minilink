<?php

$response['success'] = 0;
switch($errorMsg){
    case 0:
        $result = $conn->query($sql);
        $conn->commit();
        $response['msg'] = 'Operacao bem sucedida';
        $response['id'] = $idUrl;
        $response['success'] = 1;
        break;
    case 1:
        $response['msg'] = 'Dados nao inseridos';
        break;
    case 2:
        $response['msg'] = 'Permissao insuficiente';
        break;
    case 3:
        $response['msg'] = 'idUrl ja existente, informe outra';
        break;
    case 4:
        $response['msg'] = 'Url nao encontrada';
        break;
    default:
        $response['msg'] = 'Erro desconhecido';
        break;
}

?>