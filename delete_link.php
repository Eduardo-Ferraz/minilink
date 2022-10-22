<?php
function validate(&$response, &$request_vars){
    include ".\connect.php";

    $response['msg'] = 'Operacao bem sucedida';
    $response['success'] = 1;

    // VALIDA ENVIO DE DADOS
    if(! isset($request_vars['idUrl'])){
        $response['msg'] = 'Dados nao inseridos';
        $response['success'] = 0;
        return 0;
    }

    // VALIDA SE OS DADOS EXISTEM
    $idUrl = $request_vars['idUrl'];
    $sql = "SELECT link_ini FROM links WHERE id='$idUrl'";
	$result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($result->num_rows==0){ 
        $response['msg'] = 'Url nao encontrada';
        $response['success'] = 0;
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

include ".\connect.php";
$response= array();

if (0 === strlen(trim($request_vars = file_get_contents('php://input')))){ 
        $request_vars = false;
    } //isso salva a string "idUrl=dota5&key=ecd4d482f0e2c06e3add" em $request_vars

$request_vars = stringToDict($request_vars);

if(validate($response, $request_vars)){
    $idUrl = $request_vars['idUrl'];
    $sql = "DELETE FROM links WHERE links.id='$idUrl'";

    $conn->query($sql);
    $conn->commit();
    $conn->close();
}
echo json_encode($response);

?>