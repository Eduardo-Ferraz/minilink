<?php 
function validateIdIndex(&$novaIdUrl, $conn){
    $novaIdUrl = $_POST['pers'];
    $sql = "SELECT * FROM links WHERE id='$novaIdUrl'";
    $result = $conn->query($sql);

    if($result->num_rows!=0){
        echo "<label><b>Link personalizado já existente</b></label>";
        return 0;
    }
    if(strlen($novaIdUrl) > 10 || strlen($novaIdUrl) == 0){
        echo '<label><b>Link muito grande</b></label>';
        return 0;
    }
    if(preg_match('/[\'^£$%&*()} {@#~?><>,|=_+¬-]/', $novaIdUrl)){
        echo '<label><b>Caracteres inválidos no link</b></label>';
        return 0;
    }

    return 1;
}

if(isset($_POST["linkForm"])){
    $urlSite = $_POST['linkForm'];
    if($_POST["pers"]==null){
        // CÓDIGO DE GERAÇÃO DE STRING ALEATÓRIA //
        $novaIdUrl = substr(md5(microtime()), rand(0, 26), 5);
        $sql = "SELECT * FROM links WHERE id='$novaIdUrl'";
        $result = $conn->query($sql);

        while($result->num_rows!=0){ //Caso ja exista uma $novaIdUrl no banco de dados, seleciona outra aleatoria
            $novaIdUrl = substr(md5(microtime()), rand(0, 26), 5);

            $sql = "SELECT * FROM links WHERE id='$novaIdUrl'";
            $result = $conn->query($sql);
        }
        //--------------------------------------//
    }
    if(validateIdIndex($novaIdUrl, $conn)){
        if(isset($_SESSION['LOGIN'])){
            $idUsuario = $_SESSION['idUsuarioSessao'];
            $sql = "INSERT INTO links(link_ini, id, fk_usuario_id) VALUES ('$urlSite', '$novaIdUrl', $idUsuario);";
        }else{
            $sql = "INSERT INTO links(link_ini, id) VALUES ('$urlSite', '$novaIdUrl');";
            if(!isset($_SESSION["links"])){
                $_SESSION["links"] = array();
            }
            $_SESSION["links"][$novaIdUrl] = $urlSite;
        }
        $conn->query($sql);
        $conn->commit();
        echo "<label><b>Link encurtado com sucesso: localhost/$novaIdUrl</b></label>";
    }
}
?>