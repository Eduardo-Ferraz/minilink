<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/index.php">Minilink</a>

    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link">Links</a>
        <?php 
          if(!isset($_SESSION["LOGIN"])){
            echo '<a class="nav-link" href="/login.php">Login</a>';
            echo '<a class="nav-link" href="/registrar.php">Registrar</a>';
          }else{
            include 'connect.php';

            $sql = "SELECT keyUsuario FROM usuario WHERE id='{$_SESSION["idUsuarioSessao"]}';";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            echo '<a class="nav-link" onclick="copiar(\''.$row['keyUsuario'].'\')" href="#">Key</a>';
            echo '<a class="nav-link" href="/sair.php">Sair</a>';
          }
        
          ?>
      </div>
    </div>
  </div>
</nav>

<script>
  function copiar(key) {

  navigator.clipboard.writeText(key);
  alert("Key copiada com sucesso.");
}
</script>