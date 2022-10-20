<?php
include ".\connect.php";

$response = array();
$errorMsg = 0;

if(isset($_POST["idUrl"])){
    $idUrl = $_POST["idUrl"];

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

        if($result->num_rows==0){ // Isso é redundante? Comparar com linhas 10 a 16
            $errorMsg = 4; // // Conferir esse if, aparentemente todos os casos são == 0
        }else{
            if((!isset($_POST['key'])) || (isset($_POST['key']) && $row['keyUsuario'] !== $_POST['key'])){
                $errorMsg = 2;
            }else{
                $sql = "DELETE FROM links WHERE links.id='$idUrl'";
                $conn->query($sql);
                $conn->commit();
            }
        }
    }
    
}else{
    $errorMsg = 1;
}

include ".\mensagem.php";

$conn->close();
?>