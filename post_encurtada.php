<?php

include ".\connect.php";

$response = array();

if(isset($_POST["link"])){

    $urlSite = $_POST["link"];

    $idUrl = substr(md5(microtime()), rand(0, 26), 5);

    $sql = "SELECT * FROM links WHERE id='$idUrl'";
	$result = $conn->query($sql);

    while($result->num_rows!=0){
        $idUrl = substr(md5(microtime()), rand(0, 26), 5);

        $sql = "SELECT * FROM links WHERE id='$idUrl'";
        $result = $conn->query($sql);
    }


    if(isset($_POST['key'])){

        $sql = "SELECT id FROM usuario WHERE keyUsuario={$_POST['key']}";
        $result = $conn->query($sql);

        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $idUsuario = $row['id'];

            $sql = "INSERT INTO links(link_ini, id, fk_usuario_id) VALUES ('$urlSite', '$idUrl', $idUsuario);";
        }else{
            $sql="";
        }
    }else{
        $sql = "INSERT INTO links(link_ini, id) VALUES ('$urlSite', '$idUrl');";
    }
    if($sql!=""){
        $result = $conn->query($sql);
        $conn->commit();
        $response['msg'] = 'Mensagem recebida com sucesso';
        $response['id'] = $idUrl;
        $response['success'] = 1;
    }else{
        $response['msg'] = 'Key invalida';
        $response['success'] = 0;
    }
    
}else{
    $response['msg'] = 'Dados nao inseridos';
    $response['success'] = 0;
}

$conn->close();
echo json_encode($response);

?>