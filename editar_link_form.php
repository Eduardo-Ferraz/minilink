<?php
if(isset($_POST['linkForm'])){

    if(strlen($_POST['pers']) == 0){
        $sql = "DELETE FROM links WHERE id='{$_GET['ID']}'";
        $result = $conn->query($sql);
        $conn->commit();

        if(!isset($_SESSION['LOGIN'])){
            unset($_SESSION['links'][$_GET['ID']]);
        }

        header("Location: /links.php");
        exit;
    }else{
        if(!(strlen($_POST['pers']) > 10)){

            $sql = "SELECT * FROM links WHERE id='{$_POST['pers']}'";
            $result = $conn->query($sql);
            if($result->num_rows==0){
                $sql = "UPDATE links SET links.id='{$_POST['pers']}', links.link_ini = '{$_POST['linkForm']}'  WHERE links.id='{$_GET['ID']}'";
                $result = $conn->query($sql);
                $result = $conn->query($sql);
                $conn->commit();

                if(!isset($_SESSION['LOGIN'])){
                    $_SESSION['links'][$_POST['pers']] = $_POST['linkForm'];
                    unset($_SESSION['links'][$_GET['ID']]);
                }

                header("Location: /links.php");
                exit;
            }else{
                echo "<label><b>Link já existente</b></label>";

            }
        }else{
            echo "<label><b>ID do link muito grande!</b></label>";
        }
    }
}
?>