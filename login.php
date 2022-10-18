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
            <label for="apelidoReg" class="form-label">Apelido</label>
            <input type="text" class="form-control" name="apelidoLog" required>
        </div>
        <div class="mb-3">
            <label for="senhaReg" class="form-label">Senha</label>
            <input type="password" class="form-control" name="senhaLog" required>
        </div>
        <div id="emailHelp" class="form-text">As informações nunca serão compartilhadas.</div>
        <button type="submit" class="btn btn-primary">Login</button><br />

        <?php 
            if(isset($_POST['apelidoLog'])){
                include 'connect.php';
            
                $senha = filter_var($_POST['senhaLog'], FILTER_SANITIZE_STRING);
                $apelido = filter_var($_POST['apelidoLog'], FILTER_SANITIZE_STRING);

                $sql = "SELECT id,Senha FROM usuario WHERE apelido='$apelido';";
                $result = $conn->query($sql);
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    if (password_verify($senha, $row['Senha'])){
                        $_SESSION['LOGIN']=True;
                        $_SESSION['idUsuarioSessao']=$row['id'];
                        $host  = $_SERVER['HTTP_HOST'];
                        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                        $extra = 'index.php';
                        header("Location: http://$host$uri/$extra");
                        exit;
                    }
                    else{
                        echo "<span><label>Foram inseridos dados incorretos.</label></span>";
                    }
                }else{
                    echo "<span><label>Foram inseridos dados incorretos.</label></span>";
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