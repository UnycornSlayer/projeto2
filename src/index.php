<?php
//inicializar sess�o
session_start();

// codifica��o de carateres
ini_set('default_charset', 'ISO8859-1');
include ("assets/html/header.php");

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
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css"/>
    <!-- colocar aqui a refer�ncia ao ficheiro de estilos -->
    <title>EXEMPLO PARA GEST&Atilde;O DA BASE DE DADOS</title>
  </head>

  <body>
    <main>     
<br>
<br>
<br>

        <div class="container px-4">
  <div class="row gx-5">
    <div class="col">
     <div class="p-3 border bg-light text-dark"> <h5>A aplica&ccedil;&atilde;o</h5></div>
     <div>
      <p>A aplica&ccedil;&atilde;o CRUD destina-se exemplificar a aplica&ccedil;&atilde;o de v&aacute;rios conhecimentos na ado&ccedil;&atilde;o de PHP. 
            Por exemplo, vari&aacute;veis, ciclos, decis&otilde;es, formul&aacute;rios, manuten&ccedil;&atilde;o de bases de dados, etc.</p>
      </div>
    </div>
    <div class="col">
      <div class="p-3 border bg-light text-dark"> <h5>A abordagem</h5></div>
      <div>
                <p>Os exemplos documentados seguem uma abordagem procedimental.</p>
              </div>
    </div>
    <div class="col">
      <div class="p-3 border bg-light text-dark"> <h5>Sugest&otilde;es</h5></div>
      <div>
                <p>Sugest&otilde;es de desenvolvimento futuro: migrar para orienta&ccedil;&atilde;o a objetos ou para orienta&ccedil;&atilde;o a dados.</p>
              </div>
    </div>
  </div>
</div>


    </main>
    <script src = "../node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>
    <?php include ("assets/html/footer.html"); ?>
</body>
</html>
<?php 
} else {
  header ('Location: login.php');
} 
?>