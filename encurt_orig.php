<?php

include ".\connect.php";

$response = array();

if(isset($_POST["idUrl"])){

    $idUrl = $_POST["idUrl"];

    $sql = "SELECT link_ini FROM links WHERE id='$idUrl'";
	$result = $conn->query($sql);

    if($result->num_rows==0){
        $response['msg'] = 'Url nao encontrada';
        $response['success'] = 0;
        
    }else{
        if(isset($_POST['key'])){
            $sql = "SELECT keyUsuario FROM usuario INNER JOIN links ON usuario.id = links.fk_usuario_id WHERE links.id='$idUrl'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            
            if($row['keyUsuario'] === $_POST['key']){
                $response['msg'] = 'Url encontrada';
                $response['success'] = 1;
            }else{
                $response['msg'] = 'Permissão insuficiente';
                $response['success'] = 0;
            }
        }else{
            $result = $conn->query($sql);
            $response['msg'] = 'Url encontrada';
            $response['success'] = 1;
        }
    }
    
}else{
    $response['msg'] = 'Url nao informada';
    $response['success'] = 0;
}


$conn->close();
echo json_encode($response);

?>