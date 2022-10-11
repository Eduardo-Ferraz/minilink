<?php

include ".\connect.php";

$response = array();

if(isset($_POST["idUrl"])){
    $idUrl = $_POST["idUrl"];

    $sql = "SELECT link_ini FROM links WHERE id='$idUrl'";
	$result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($result->num_rows==0){
        $response['msg'] = 'Url nao encontrada';
        $response['success'] = 0;
        
    }else{
        $link_ini = $row['link_ini'];

        $sql = "SELECT keyUsuario FROM usuario INNER JOIN links ON usuario.id = links.fk_usuario_id WHERE links.id='$idUrl'";
        $result = $conn->query($sql);
        
        if($result->num_rows!=0 && isset($_POST['key'])){
            if($row['keyUsuario'] === $_POST['key']){
                $response['msg'] = 'Url encontrada';
                $response['link'] = $link_ini;
                $response['success'] = 1;
            }else{
                $response['msg'] = 'Permissao insuficiente';
                $response['success'] = 0;
            }
        }else{
            $response['msg'] = 'Url encontrada';
            $response['link'] = $link_ini;
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