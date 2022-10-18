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

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Siimple - v4.8.1
  * Template URL: https://bootstrapmade.com/free-bootstrap-landing-page/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header">
      <?php include 'nav.php'; ?>
  </header>

  <section id="hero">
    <div class="hero-container">
    <div >
        <form method="POST">
        <div class="mb-3">
            <label for="emailReg" class="form-label">Email</label>
            <input type="email" class="form-control" name="emailReg" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="apelidoReg" class="form-label">Apelido</label>
            <input type="text" class="form-control" name="apelidoReg" required>
        </div>
        <div class="mb-3">
            <label for="senhaReg" class="form-label">Senha</label>
            <input type="password" class="form-control" name="senhaReg" required>
        </div>
        <div id="emailHelp" class="form-text">As informações nunca serão compartilhadas.</div>
        <button type="submit" class="btn btn-primary">Registrar</button><br />

        <?php 
            if(isset($_POST['apelidoReg'])){
                include 'connect.php';

                $apelido = filter_var($_POST['apelidoReg'], FILTER_SANITIZE_STRING);
                $email = filter_var($_POST['emailReg'], FILTER_SANITIZE_EMAIL);
                $senha = filter_var($_POST['senhaReg'], FILTER_SANITIZE_STRING);

                $sql = "SELECT * FROM usuario WHERE Apelido='$apelido' OR Email='$email'";
                $result = $conn->query($sql);

                if ($result->num_rows == 0){
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ //Não foi necessária a utilização de outro filtro.
                        $sql = "SELECT * FROM usuario ORDER BY id DESC LIMIT 1";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $idUsuario=$row['id']+1;
                            }
                        }else{
                            $idUsuario = 1;
                        }

                        $keyUser = substr(md5(microtime()), rand(0, 26), 20);

                        $sql = "SELECT * FROM usuario WHERE keyUsuario='$keyUser'";
                        $result = $conn->query($sql);

                        while($result->num_rows!=0){ //Caso ja exista uma $idUrl no banco de dados, seleciona outra aleatoria
                            $idUrl = substr(md5(microtime()), rand(0, 26), 20);
                            $sql = "SELECT * FROM usuario WHERE id='$keyUser'";
                            $result = $conn->query($sql);
                        }

                        $hash = password_hash($senha, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO usuario(keyUsuario, email, apelido, senha, id) VALUES ('$keyUser', '$email', '$apelido', '$hash', $idUsuario);";
                        $result = $conn->query($sql);
                        $conn->commit();
                        echo "<label><span>Conta criada com sucesso.</span></label>";
                    }else{
                        echo "<label><span>Foi preenchido algum dado incorretamente.</span></label>";
                    }
                }else{
                    echo "<label><span>Foi colocado um email ou apelido existente.</span></label>";
                }
                $conn->close();
            }
            ?>


        </form>
    </div>
</div>
</section>

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Minilink</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-landing-page/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End #footer -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>