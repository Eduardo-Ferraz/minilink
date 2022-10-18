<?php
function validate(&$response){
    include ".\connect.php";

    $response['msg'] = 'Operacao bem sucedida';
    $response['success'] = 1;

    if(! isset($_POST["idUrl"])){
        $response['msg'] = 'Dados nao inseridos';
        $response['success'] = 0;
        return 0;
    }

    $idUrl = $_POST["idUrl"];
    $sql = "SELECT link_ini FROM links WHERE id='$idUrl'";
	$result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $link_ini = $row['link_ini'];

    if($result->num_rows==0){
        $response['msg'] = 'Url nao encontrada';
        $response['success'] = 0;
        return 0;
    }

    $sql = "SELECT keyUsuario FROM usuario INNER JOIN links ON usuario.id = links.fk_usuario_id WHERE links.id='$idUrl'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

    if(($result->num_rows!=0 && isset($_POST['key']) && $row['keyUsuario'] !== $_POST['key']) ||
        ($result->num_rows!=0 && !isset($_POST['key']))){

        $response['msg'] = 'Permissao insuficiente';
        $response['success'] = 0;
        return 0;
    }
    
    if($result->num_rows==0){ // Isso é redundante? Comparar com linhas 10 a 16
        $response['msg'] = 'Url nao encontrada';
        $response['success'] = 0;
        return 0;
    }
    if(((! isset($_POST['key'])) || (isset($_POST['key']) && ($row['keyUsuario'] !== $_POST['key'])))){
        $response['msg'] = 'Permissao insuficiente';
        $response['success'] = 0;
        return 0;
    }
}

include ".\connect.php";

$response= array();
$valido = validate($response);
$response['check'] = $valido;


if($valido){
    echo "validou";
    $idUrl = $_POST["idUrl"];
    $sql = "DELETE FROM links WHERE links.id='$idUrl'";

    $conn->query($sql);
    $conn->commit();
    $conn->close();
}
echo json_encode($response);

?>