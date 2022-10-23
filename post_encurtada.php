<?php
function validate(&$response){
    include ".\connect.php";

    $response['msg'] = 'Operacao bem sucedida';
    $response['success'] = 200;

    // VALIDA ENVIO DE DADOS
    if(! isset($_POST['link'])){
        $response['msg'] = 'Dados nao inseridos';
        $response['success'] = 204; // Nenhum conteúdo
        return 0;
    }

    return 1;
}

function validateIdUrl(&$response){
    include ".\connect.php";

    $idUrl = $_POST["idUrl"];
    
    $sql = "SELECT * FROM links WHERE id='$idUrl'";
    $result = $conn->query($sql);
    
    if($result->num_rows!=0){
        $response['msg'] = 'idUrl ja existente, informe outra';
        $response['success'] = 406; // Não aceito
        return 0;
    }
    return 1;
}

function validateAut(&$response){
    include ".\connect.php";

    // VALIDA AUTORIZAÇÃO
    $sql = "SELECT id FROM usuario WHERE keyUsuario='{$_POST['key']}'";
    $result = $conn->query($sql);

    if($result->num_rows==0){
        $response['msg'] = 'Permissao insuficiente';
        $response['success'] = 401; // Não autorizado
        return 0;
    }

    $row = $result->fetch_assoc();
    $idUsuario = $row['id'];
    return $idUsuario;
}

include ".\connect.php";

$response = array();
$errorMsg = 0;
if(validate($response)){
    $urlSite = $_POST["link"];
    if(isset($_POST["idUrl"])){
        $checkIdUrl = validateIdUrl($response);
        $idUrl = $_POST["idUrl"];
    }else{
        // CÓDIGO DE GERAÇÃO DE STRING ALEATÓRIA //
        $idUrl = substr(md5(microtime()), rand(0, 26), 5);
        $sql = "SELECT * FROM links WHERE id='$idUrl'";
        $result = $conn->query($sql);
    
        while($result->num_rows!=0){ //Caso ja exista uma $idUrl no banco de dados, seleciona outra aleatoria
            $idUrl = substr(md5(microtime()), rand(0, 26), 5);
    
            $sql = "SELECT * FROM links WHERE id='$idUrl'";
            $result = $conn->query($sql);
        }
        //--------------------------------------//
        $checkIdUrl = 1;
    }
    
    if($checkIdUrl){
        if(isset($_POST['key'])){
            if($idUsuario = validateAut($response) != 0){
                $sql = "INSERT INTO links(link_ini, id, fk_usuario_id) VALUES ('$urlSite', '$idUrl', $idUsuario);";
                $conn->query($sql);
                $conn->commit();
            }
        }else{
            $sql = "INSERT INTO links(link_ini, id) VALUES ('$urlSite', '$idUrl');";
            $conn->query($sql);
            $conn->commit();
        }
    }
}

$conn->close(); // No final do arquivo, certo?????
echo json_encode($response);
?>