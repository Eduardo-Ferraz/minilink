<?php

include ".\connect.php";

$response = array();

if(isset($_POST["idUrl"])){

    $idUrl = $_POST["idUrl"];

    $sql = "SELECT link_ini FROM links WHERE id='$idUrl'";
	$result = $conn->query($sql);

    if($result->num_rows==0){
        $response['msg'] = 'Url nao encontrada';
        $response['success'] = 0;
        
    }else{
        if(isset($_POST['key'])){
            if($_POST['key'] === $idUrl){
                $result = $conn->query($sql);
                $conn->commit();
                $conn->close();
                $response['msg'] = 'Url encontrada';
                $response['success'] = 1;
            }else{
                $response['msg'] = 'Permissão insuficiente';
                $response['success'] = 0;
            }
        }else{
            $result = $conn->query($sql);
            $conn->commit();
            $conn->close();
            $response['msg'] = 'Url encontrada';
            $response['success'] = 1;
        }
    
        
    }


    
}else{
    $response['msg'] = 'Url nao informada';
    $response['success'] = 0;
}

echo json_encode($response);

?>