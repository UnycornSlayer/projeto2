<?php
//inicializar sess�o
session_start();

// codifica��o de carateres
ini_set('default_charset', 'ISO8859-1');

if( $_SESSION['login'] == TRUE){
?>
<!DOCTYPE html>
<html lang="pt">

  <head>
	  <meta http-equiv="content-type" content="text/html; charset=ISO8859-1">
    <meta charset="ISO8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- colocar aqui a refer�ncia ao ficheiro de estilos -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>EXEMPLO PARA GEST&Atilde;O DA BASE DE DADOS</title>
  </head>

  <body>
  <header>
      <!-- navbar -->
      <nav>
        <a href="#">CRUD</a>
        <div>
          <ul>
            <li>
              <a href="index.php">Home</a>
            </li>
            <li>
              <a href="read.php">Listagem</a>
            </li>
            <li >
              <a href="create.php">Criar Novo</a>
            </li>
            <li>
              <a href="close_session.php">Terminar sess&atilde;o</a>
            </li>
          </ul>

          <!-- pesquisa -->
          <form name="frmPesquisa" method="post" action="read.php">
            <input type="text" placeholder="Pesquisa" aria-label="Search" name="pesquisa">
            <button type="submit">Pesquisar</button>
          </form>

        </div>
      </nav>
      <!-- /.navbar -->
    </header>

    <main>     
      <div><!-- contentor --> 
        <div>
          <div>
            <div>
              <div>
                <h5>A aplica&ccedil;&atilde;o</h5>
              </div>
              <div>
                <p>A aplica&ccedil;&atilde;o CRUD destina-se exemplificar a aplica&ccedil;&atilde;o de v&aacute;rios conhecimentos na ado&ccedil;&atilde;o de PHP. 
            Por exemplo, vari&aacute;veis, ciclos, decis&otilde;es, formul&aacute;rios, manuten&ccedil;&atilde;o de bases de dados, etc.</p>
              </div>
            </div>
          </div>
          <div>
            <div>
              <div>
                <h5>A abordagem</h5>
              </div>
              <div>
                <p>Os exemplos documentados seguem uma abordagem procedimental.</p>
              </div>
            </div>
          </div>  
          <div>
            <div>
              <div>
                <h5>Sugest&otilde;es</h5>
              </div>
              <div>
                <p>Sugest&otilde;es de desenvolvimento futuro: migrar para orienta&ccedil;&atilde;o a objetos ou para orienta&ccedil;&atilde;o a dados.</p>
              </div>
            </div>
          </div>
        </div>
        
      </div><!-- /.container -->




      <!-- FOOTER -->
      <footer>
        <p>&copy; 2021 Jos&eacute; Monteiro</p>
      </footer>
      <!-- /.FOOTER -->
    </main>
    <script src = "../node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>
</body>
</html>
<?php 
} else {
  header ('Location: login.php');
} 
?>