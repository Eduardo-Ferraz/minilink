<?php 
if(isset($_POST["linkForm"])){
    $urlSite = $_POST['linkForm'];
    if($_POST["pers"]==null){
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
    }else{
        $idUrl = $_POST['pers'];
        $sql = "SELECT * FROM links WHERE id='$idUrl'";
        $result = $conn->query($sql);
        if($result->num_rows!=0){
            $idPers = true;
        }
    }
    if(!(strlen($idUrl) > 10 || strlen($idUrl) == 0)){
        if(!isset($idPers)){
            if(isset($_SESSION['LOGIN'])){
                $idUsuario = $_SESSION['idUsuarioSessao'];
                $sql = "INSERT INTO links(link_ini, id, fk_usuario_id) VALUES ('$urlSite', '$idUrl', $idUsuario);";
            }else{
                $sql = "INSERT INTO links(link_ini, id) VALUES ('$urlSite', '$idUrl');";
                if(!isset($_SESSION["links"])){
                    $_SESSION["links"] = array();
                }
                $_SESSION["links"][$idUrl] = $urlSite;
            }
            $conn->query($sql);
            $conn->commit();
            echo "<label><b>Link encurtado com sucesso: localhost/$idUrl</b></label>";
        }else{
            echo "<label><b>Link personalizado já existente</b></label>";
        }

    }else{
        echo '<label><b>Link muito grande</b></label>';
    }

}


?>