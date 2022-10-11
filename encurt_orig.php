<?php

include ".\connect.php";

$response = array();

if(isset($_POST["idUrl"])){

    $idUrl = $_POST["idUrl"];


    $sql = "SELECT link_ini FROM links WHERE id='$idUrl'";
	$result = $conn->query($sql);

    if($result->num_rows==0){
        // nenhum registro encontrado
        
    }


    if(isset($_POST['fk_usuario_id'])){
        // exigir autenticação?
    }

    $result = $conn->query($sql);
    $conn->commit();
    $conn->close();
    $response['msg'] = 'Url encontrada';
    $response['success'] = 1;
}else{
    $response['msg'] = 'Url nao encontrada';
    $response['success'] = 0;
}

echo json_encode($response);

?>