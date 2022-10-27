<?php
function stringToDict($str){ // Recebe a string "key1=value1&key2=value2" ou "key1=value1" e retorna um array associativo (dict)
    if(strlen(strchr($str,"&")) != 0){
        $array = explode("&",$str);
        $array2 = explode("=",$array[0]);
        $array3 = explode("=",$array[1]);
        $array = array_merge($array2, $array3);

        $dict = array( $array[0] => $array[1], $array[2] => $array[3]);
    }else{
        $array = explode("=",$str);
        $dict = array( $array[0] => $array[1]);
    }

    return $dict;
}

include ".\\func_validate_geral.php";
include ".\connect.php";
$response= array();

if (0 === strlen(trim($request_vars = file_get_contents('php://input')))){ 
        $request_vars = false;
        $response['msg'] = 'Dados nao inseridos';
        http_response_code(400); // Bad Request
    } // Salva a string "idUrl=dota5&key=ecd4d482f0e2c06e3add" em $request_vars

$request_vars = stringToDict($request_vars);

if(validateGeral($response, $request_vars)){
    $idUrl = $request_vars['idUrl'];
    $sql = "DELETE FROM links WHERE links.id='$idUrl'";
    $conn->query($sql);
    $conn->commit();
}

$response['responseCode'] = http_response_code();
echo json_encode($response);
$conn->close();
?>