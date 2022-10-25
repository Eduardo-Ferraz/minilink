<?php
function gerarIdRand(){
    include ".\connect.php";

    $novaIdUrl = substr(md5(microtime()), rand(0, 26), 5);
    $sql = "SELECT * FROM links WHERE id='$novaIdUrl'";
    $result = $conn->query($sql);

    while($result->num_rows!=0){ //Caso ja exista uma $novaIdUrl no banco de dados, seleciona outra aleatoria
        $novaIdUrl = substr(md5(microtime()), rand(0, 26), 5);

        $sql = "SELECT * FROM links WHERE id='$novaIdUrl'";
        $result = $conn->query($sql);
    }

    return $novaIdUrl;
}
?>