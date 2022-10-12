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
        $sql = "SELECT keyUsuario FROM usuario INNER JOIN links ON usuario.id = links.fk_usuario_id WHERE links.id='$idUrl'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        if(($result->num_rows!=0 && isset($_POST['key']) && $row['keyUsuario'] !== $_POST['key']) ||
            ($result->num_rows!=0 && !isset($_POST['key']))){

            $response['msg'] = 'Permissao insuficiente';
            $response['success'] = 0;

        }else{
            $sql = "DELETE FROM links WHERE links.id='$idUrl'";
            $conn->query($sql);

            $response['msg'] = 'Url encontrada e deletada';
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


// DELETE FROM `links` WHERE `links`.`id` = 'fc06d'
?>
