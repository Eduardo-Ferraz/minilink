<?php

include ".\connect.php";
//$new_url = ""; Precisa disso?

if(isset($_POST["link"])){
    $new_url = $_POST["link"];
    //$sql = "SELECT linkIni * FROM 'url' ORDER BY id ASC;";

    $sql = "INSERT INTO url(linkIni, id, fk_usuario_id) VALUES ('$new_url', '1', '2');";
			$result = $conn->query($sql);
			$conn->commit();
			echo "<label><span>Link enviado para ser encurtado.</span></label>";
}

?>