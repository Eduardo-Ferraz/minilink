<?php
  require_once 'connect.php';

  session_start();
  if(isset($_GET['link'])){

    $idUrl = $_GET['link'];
    $sql = "SELECT link_ini FROM links WHERE id='$idUrl'";

    $result = $conn->query($sql);
    if($result != false and $result->num_rows!=0){
      $row = $result->fetch_assoc();
      $linkFinal = $row["link_ini"];

      if(strpos($linkFinal,'https://')===false){
        Header("Location: https://".$linkFinal);
      }else{
        Header("Location: ".$linkFinal);
      }

      die();
    }else{
      echo 'Erro ao localizar o link.';
    }
  }

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Minilink</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <header id="header">
      <?php include 'nav.php'; ?>
  </header>

  <section id="hero">
    <div class="hero-container">

    <table class = "container" style="background-color: white;">
    
    <thead>
				<th> Link </th> 
				<th> Link encurtado </th>
			</thead>
			<tbody>
        <?php
        if(!isset($_SESSION["LOGIN"]) && isset($_SESSION['links'])){
          foreach($_SESSION["links"] as $i => $value){
            echo "<tr>";
            echo "<td>$value</td>\n<td><a href='./$i'>localhost/$i</a></td>";
            echo "<td><button type='button' onclick=\"window.location='/editar_link.php?ID={$i}'\"><i class='material-icons'>edit</i></button></td>";
            echo "</tr>";
          }
        }else if(isset($_SESSION["LOGIN"])){
          $sql = "SELECT links.link_ini, links.id FROM links INNER JOIN usuario ON usuario.id=links.fk_usuario_id WHERE usuario.id = {$_SESSION['idUsuarioSessao']}";
          $result = $conn->query($sql);
          if ($result and $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>{$row['link_ini']}</td>\n<td><a href='./{$row['id']}'>localhost/{$row['id']}</a></td>";
              echo "<td><button type='button' onclick=\"window.location='/editar_link.php?ID={$row["id"]}'\"><i class='material-icons'>edit</i></button></td>";
              echo "</tr>";
            }


          }
        }
          
        ?>
			</tbody>
		</table>
</div>
</section>

  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Minilink</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <script src="assets/js/main.js"></script>

</body>

</html>