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

  if(!isset($_GET['ID'])){
    header("Location: index.php");
    exit;
  }else{
    if(isset($_SESSION['LOGIN'])){
        $sql = "SELECT link_ini FROM links WHERE id='{$_GET['ID']}' AND fk_usuario_id={$_SESSION['idUsuarioSessao']}";
    }else{
        $sql = "SELECT link_ini FROM links WHERE id='{$_GET['ID']}' AND fk_usuario_id is NULL"; 
    }
    $result = $conn->query($sql);
    if($result->num_rows == 0){
        header("Location: index.php");
        exit;
    }else{
        $row = $result->fetch_assoc();
        $linkFinal = $row['link_ini'];
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
      <h2>Informe abaixo as informações para editar o link!</h2>

      <form method="POST">
        <div class = "row no-gutters">
        <div class="col-md-6 form-group pr-md-1">
            <input type="text" class="form-control" name="linkForm" value="<?php echo $linkFinal; ?>" required>
        </div>
        <div class="col-md-6 form-group pr-md-1">
            <input type="text" class="form-control" name="pers" value="<?php echo $_GET['ID']; ?>">
        </div>
    </div>
    <br />
        <label>Para excluir deixe o id em branco</label> <br /><br />
        <button type="submit" class="btn btn-primary" style="background-color: orange !important; border: none !important;">Editar link!</button>
  </form>

      <?php include 'editar_link_form.php'; ?>
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