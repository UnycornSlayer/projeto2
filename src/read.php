<?PHP
//inicializar ses�o
session_start();
include ("assets/html/header.php");
// codifica��o de carateres
ini_set('default_charset', 'ISO8859-1');

if( $_SESSION['login'] == TRUE){

// estabelecer a liga��o � base de dados
include ("connect.php");

?>

<!DOCTYPE html>
<html lang="pt">

  <head>
	  <meta http-equiv="content-type" content="text/html; charset=ISO8859-1">
    <meta charset="ISO8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">

    <title>EXEMPLO PARA GEST&Atilde;O DA BASE DE DADOS</title>
  </head>
  <body>
    
<main class="form-signin w-100 m-auto">    
      <div><!-- contentor -->   
        <div class="text-center"> <!-- titulo -->
            <legend>C<strong>Read</strong>UD</legend>
        </div>
      
        <div class="text-center"> <!-- info -->
            <p>Foram encontrado(s) <?PHP echo mysqli_num_rows ($result)?> registo(s).</p>
        </div>
        <br>
        <div class="d-flex justify-content-center"> <!-- listagem -->
  			<table>
				<tr>
					<td width="80"><strong>C&Oacute;DIGO</strong></td>
					<td><strong>NOME</strong></td>
					<td><strong>EMAIL</strong></td>
					<td width="80"><strong>ALTERAR</strong></td>
					<td width="80"><strong>ELIMINAR</strong></td>
				</tr>
				<?php while ($row = mysqli_fetch_assoc ($result)) { ?>
				<tr>
				<td><?PHP echo $row ["codigo"]?></td>
				<td><?PHP echo $row ["nome"]?></td>
				<td><?PHP echo $row ["email"]?></td>
				<td><button class="btn btn-dark link-light"><a href="update.php?codigo=<?PHP echo $row ["codigo"]?>" class="link-light">Alterar</a></button></td>
				<td><button type="button" class="btn btn-dark link-light" data-bs-toggle="modal"data-bs-target="#exampleModal<?PHP echo $row ["codigo"]?>">Eliminar</button></td>

              
        <!-- Modal -->
  <div id="exampleModal<?PHP echo $row ["codigo"]?>" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem a certeza que pretrende apagar o registo com o código <?PHP echo $row ["codigo"]?> ? 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <a type="button" class="btn btn-danger" href="delete.php?codigo=<?PHP echo $row ["codigo"]?>">Yes</a>
      </div>
    </div>
  </div>
</div>

				</tr>

				<?php } ?>
			</table>

      </div><!-- /.listagem -->
      </div><!-- /.container -->

<br><br>
      <?php include ("assets/html/footer.html"); ?>
    </main>
    <script src = "../node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>
</body>
</html>
<?php
// fechar a liga��o � base de dados
mysqli_close ($conn);

} else {
  header ('Location: login.php');
} 
?>
    

