<?php
// codifica��o de carateres
ini_set('default_charset', 'ISO8859-1');

// estabelecer a liga��o � base de dados
include ("connect.php");

if(isset ($_POST['pesquisa'])) {
	$query = "SELECT * FROM contatos WHERE nome LIKE '%$_POST[pesquisa]%' OR email LIKE '%$_POST[pesquisa]%'";
	$result = mysqli_query ($conn, $query);	
} else {
	$query = "SELECT * FROM contatos";
	$result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css"/>
  </head>
  <body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a href="index.php" class="nav-link text-dark"><b>Home</b></a></li>
        <li class="nav-item"><a href="read.php" class="nav-link text-dark">Listagem</a></li>
        <li class="nav-item"><a href="create.php" class="nav-link text-dark">Criar Novo</a></li>
        <li class="nav-item"><a href="profile.php" class="nav-link text-dark">Perfil</a></li>
        <li class="nav-item"><a href="close_session.php" class="nav-link text-dark">Terminar Sess&atilde;o</a></li>
      </ul>
      <form class="d-flex col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="read.php" method="POST">
        <input class="form-control me-2" type="text" name="pesquisa" placeholder="Pesquisa">
        <button class="btn btn-dark" type="submit">Search</button>
      </form>

      </div>

  </div>
</nav>
  </body>
</html>
