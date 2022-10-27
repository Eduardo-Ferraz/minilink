<?php
function validateIdUrl(&$response, &$request_vars){
    include ".\connect.php";

    $novaIdUrl = $request_vars['novaIdUrl'];
    $sql = "SELECT * FROM links WHERE links.id='$novaIdUrl'";
    $result = $conn->query($sql);
    
    if($result->num_rows!=0){
        $response['msg'] = 'idUrl ja existente, informe outra';
        http_response_code(409); // Conflict
        return 0;
    }
    if(strlen($novaIdUrl) > 10 || strlen($novaIdUrl) == 0){
        $response['msg'] = 'id de tamanho invalido';
        http_response_code(400); // Bad Request
        return 0;
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $novaIdUrl)){
        $response['msg'] = 'id com caracteres invalidos';
        http_response_code(400); // Bad Request
        return 0;
    }

    return 1;
}
?>