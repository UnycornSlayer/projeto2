<?PHP
//inicializar ses�o
session_start();

// codifica��o de carateres
ini_set('default_charset', 'ISO8859-1');

if( $_SESSION['login'] == TRUE){

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
<html lang="pt">

  <head>
	  <meta http-equiv="content-type" content="text/html; charset=ISO8859-1">
    <meta charset="ISO8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- colocar aqui a refer�ncia ao ficheiro de estilos -->
    <link href="" rel="stylesheet">
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
          <form  name="frmPesquisa" method="post" action="read.php">
            <input type="text" placeholder="Pesquisa" aria-label="Search" name="pesquisa">
            <button type="submit">Pesquisar</button>
          </form>

        </div>
      </nav>
      <!-- /.navbar -->
    </header>

    <main>     
      <div><!-- contentor -->   
        <div > <!-- titulo -->
            <legend>C<strong>Read</strong>UD</legend>
        </div>

        <div> <!-- info -->
            <p>Foram encontrado(s) <?PHP echo mysqli_num_rows ($result)?> registo(s).</p>
        </div>

        <div> <!-- listagem -->
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
				<td><a href="update.php?codigo=<?PHP echo $row ["codigo"]?>">Alterar</a></td>
				<td><a href="delete.php?codigo=<?PHP echo $row ["codigo"]?>">Eliminar</a></td>
				</tr>
				<?php } ?>
			</table>

      </div><!-- /.listagem -->
      </div><!-- /.container -->


      <!-- FOOTER -->
      <footer">
        <p>&copy; 2021 Jos&eacute; Monteiro</p>
      </footer>
      <!-- /.FOOTER -->
    </main>
</body>
</html>
<?php
// fechar a liga��o � base de dados
mysqli_close ($conn);

} else {
  header ('Location: login.php');
} 
?>
    

