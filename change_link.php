<?php
include ".\connect.php";

$response = array();
$errorMsg = 0;

if(isset($_POST["idUrl"])){
    $idUrl = $_POST["idUrl"];

    $sql = "SELECT link_ini FROM links WHERE id='$idUrl'";
	$result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($result->num_rows==0){
        $errorMsg = 4;
        
    }else{
        $sql = "SELECT keyUsuario FROM usuario INNER JOIN links ON usuario.id = links.fk_usuario_id WHERE links.id='$idUrl'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if(($result->num_rows!=0 && isset($_POST['key']) && $row['keyUsuario'] !== $_POST['key']) &&
            ($result->num_rows!=0 && !isset($_POST['key']))){
            $errorMsg = 2;

        }else{
            if(isset($_POST["novaIdUrl"])){
                $novaIdUrl = $_POST['novaIdUrl'];
                $sql = "SELECT * FROM links WHERE links.id = '$novaIdUrl'";
                $result = $conn->query($sql);
            }else{
                // CÓDIGO DE GERAÇÃO DE STRING ALEATÓRIA //
                $novaIdUrl = substr(md5(microtime()), rand(0, 26), 5);
                $sql = "SELECT * FROM links WHERE id='$novaIdUrl'";
                $result = $conn->query($sql);

                while($result->num_rows!=0){ //Caso ja exista uma $novaIdUrl no banco de dados, seleciona outra aleatoria
                    $novaIdUrl= substr(md5(microtime()), rand(0, 26), 5);

                    $sql = "SELECT * FROM links WHERE id='$novaIdUrl'";
                    $result = $conn->query($sql);
                }
                //--------------------------------------//
            }
            if($result->num_rows!=0){
                $errorMsg=3;
            }else if(strlen($novaIdUrl) > 10 || strlen($novaIdUrl) == 0){
                $errorMsg=5;
            }else{
                $sql = "UPDATE links SET links.id='$novaIdUrl' WHERE links.id='$idUrl'";
                $response['novaIdUrl'] = $novaIdUrl;
            }
        }
    }
    
}else{
    $errorMsg = 1;
}

include ".\mensagem.php";

$conn->close();
?>