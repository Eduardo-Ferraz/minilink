<?php
include ".\connect.php";

$response = array();
$errorMsg = 0;

if(isset($_POST["idUrl"]) && isset($_POST["novaidUrl"])){
    $idUrl = $_POST["idUrl"];
    $novaidUrl = $_POST["novaidUrl"];

    $sql = "SELECT link_ini FROM links WHERE id='$idUrl'";
	$result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $link_ini = $row['link_ini'];

    if($result->num_rows==0){
        $errorMsg = 4;
        
    }else{
        $sql = "SELECT keyUsuario FROM usuario INNER JOIN links ON usuario.id = links.fk_usuario_id WHERE links.id='$idUrl'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        if(($result->num_rows!=0 && isset($_POST['key']) && $row['keyUsuario'] !== $_POST['key']) ||
            ($result->num_rows!=0 && !isset($_POST['key']))){

            $errorMsg = 2;

        }else{
            $sql = "UPDATE links SET links.id='$novaidUrl'";
            $conn->query($sql);
            $conn->commit();
        }
    }
    
}else{
    $errorMsg = 1;
}

include ".\mensagem.php";

$conn->close();
?>