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
        <button type="submit" class="btn btn-primary" style="background-color: orange !important; border: none !important;">Registrar</button><br />

        <?php 
  if(isset($_POST['apelidoReg'])){

      $apelido = filter_var($_POST['apelidoReg'], FILTER_SANITIZE_STRING);
      $email = filter_var($_POST['emailReg'], FILTER_SANITIZE_EMAIL);
      $senha = filter_var($_POST['senhaReg'], FILTER_SANITIZE_STRING);

      $sql = "SELECT * FROM usuario WHERE Apelido='$apelido' OR Email='$email'";
      $result = $conn->query($sql);

      if ($result->num_rows == 0){
          if(filter_var($email, FILTER_VALIDATE_EMAIL)){ //Filtro para valdiar o email

              $sql = "SELECT * FROM usuario ORDER BY id DESC LIMIT 1"; //Verificação do id para realizar o incremento para criar um novo id
              $result = $conn->query($sql);
              if ($result->num_rows > 0) { //Se já existir, o id será igual ao id do último usuário mais um
                  while($row = $result->fetch_assoc()) {
                      $idUsuario=$row['id']+1;
                  }
              }else{ //Se não, o id será igual a 1
                  $idUsuario = 1;
              }

              $keyUser = substr(md5(microtime()), rand(0, 26), 20); //Mesma geração do id do link, mas para uma string de 20 caracteres

              $sql = "SELECT * FROM usuario WHERE keyUsuario='$keyUser'"; 
              $result = $conn->query($sql);

              while($result->num_rows!=0){ //Caso ja exista uma $keyUser no banco de dados, seleciona outra aleatoria
                  $idUrl = substr(md5(microtime()), rand(0, 26), 20);
                  $sql = "SELECT * FROM usuario WHERE id='$keyUser'";
                  $result = $conn->query($sql);
              }

              $hash = password_hash($senha, PASSWORD_DEFAULT);
              
              $sql = "INSERT INTO usuario(keyUsuario, email, apelido, senha, id) VALUES ('$keyUser', '$email', '$apelido', '$hash', $idUsuario);"; //Insere no banco de dados a informação passada no form
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