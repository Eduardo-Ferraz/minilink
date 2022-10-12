<?php

include ".\connect.php";

$response = array();
$errorMsg = 0;

if(isset($_POST["link"])){

    $urlSite = $_POST["link"];
    
    if(isset($_POST["idUrl"])){
        $idUrl = $_POST["idUrl"];

        $sql = "SELECT * FROM links WHERE id='$idUrl'";
        $result = $conn->query($sql);
        
        if($result->num_rows!=0){
            $errorMsg = 2;
        }
    }else{
        $idUrl = substr(md5(microtime()), rand(0, 26), 5);

        $sql = "SELECT * FROM links WHERE id='$idUrl'";
        $result = $conn->query($sql);

        while($result->num_rows!=0){ //Caso ja exista uma $idUrl no banco de dados, seleciona outra aleatoria
            $idUrl = substr(md5(microtime()), rand(0, 26), 5);

            $sql = "SELECT * FROM links WHERE id='$idUrl'";
            $result = $conn->query($sql);
        }
    }

    if(isset($_POST['key'])){

        $sql = "SELECT id FROM usuario WHERE keyUsuario={$_POST['key']}";
        $result = $conn->query($sql);

        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $idUsuario = $row['id'];

            $sql = "INSERT INTO links(link_ini, id, fk_usuario_id) VALUES ('$urlSite', '$idUrl', $idUsuario);";
        }else{
            $errorMsg = 3;
        }
    }else{
        $sql = "INSERT INTO links(link_ini, id) VALUES ('$urlSite', '$idUrl');";
    }
    
}else{
    $errorMsg=1;
}

switch($errorMsg){
    case 0:
        $result = $conn->query($sql);
        $conn->commit();
        $response['msg'] = 'Mensagem recebida com sucesso';
        $response['id'] = $idUrl;
        $response['success'] = 1;
        break;
    case 1:
        $response['msg'] = 'Dados nao inseridos';
        $response['success'] = 0;
        break;
    case 2:
        $response['msg'] = 'idUrl ja existente, informe outra';
        $response['success'] = 0;
        break;
    case 3:
        $response['msg'] = 'Key invalida';
        $response['success'] = 0;
        break;
    default:
        $response['msg'] = 'Erro desconhecido';
        $response['success'] = 0;
        break;
}

$conn->close();
echo json_encode($response);

?>