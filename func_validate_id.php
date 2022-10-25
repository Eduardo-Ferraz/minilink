<?php
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
?>