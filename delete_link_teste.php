<?php
function validate(&$response){
    include ".\connect.php";

    $response['msg'] = 'Operacao bem sucedida';
    $response['success'] = 1;

    // VALIDA ENVIO DE DADOS
    if(! isset($_POST["idUrl"])){
        $response['msg'] = 'Dados nao inseridos';
        $response['success'] = 0;
        return 0;
    }

    // VALIDA SE OS DADOS EXISTEM
    $idUrl = $_POST["idUrl"];
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

    if($result->num_rows!=0 && ((!isset($_POST['key'])) || (isset($_POST['key']) && $row['keyUsuario'] !== $_POST['key']))){
        $response['msg'] = 'Permissao insuficiente';
        $response['success'] = 401; // Não autorizado
        return 0;
    }

    return 1;
}

include ".\connect.php";

$response= array();

if(validate($response)){
    $idUrl = $_POST["idUrl"];
    $sql = "DELETE FROM links WHERE links.id='$idUrl'";

    $conn->query($sql);
    $conn->commit();
    $conn->close();
}
echo json_encode($response);

?>