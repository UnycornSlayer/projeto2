<?php
//inicializar sessão
session_start();

// codificação de carateres
ini_set('default_charset', 'ISO8859-1');

if( $_SESSION['login'] == TRUE){

// estabelecer a ligação à base de dados
include ("connect.php");

// inicialização de variáveis
$nomeErr = $emailErr = "";
$nome = $email = "";

switch ($_SERVER["REQUEST_METHOD"]){
	case 'POST':
		$codigo = $_POST['codigo'];
		break;
	case 'GET':
		$codigo = $_GET['codigo'];
		break;
}

// verifica se foi inserido cÃ³digo
function test_input($dados) {
	$dados = trim($dados);
	$dados = stripslashes($dados);
	$dados = htmlspecialchars($dados);
	return $dados;
  }

if($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["nome"])) {
		$nomeErr = "<strong>Não deve apagar o Nome existente.</strong> PF introduza um Nome válido!";
	} else {
		$nome = test_input($_POST["nome"]);
		// verifica se o nome contem carateres com ou sem assento e espaÃ§os
		if (!preg_match("/^[a-zA-Z-' ]*$/",$nome)) {
		  $nomeErr = "O Nome nÃ£o deve conter cararteres especiais ou números!";
		}
	}
	  
	if (empty($_POST["email"])) {
		$emailErr = "<strong>Não deve apagar o Nome existente.</strong> PF digite um Email válido!";
	} else {
		$email = test_input($_POST["email"]);
		// verifica o formato do email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "O formato do Email é inválido.";
		}
	}

	if ($nomeErr =="" AND $emailErr == ""){
		$query = "UPDATE contatos SET nome = '$nome', email = '$email' WHERE codigo = $codigo";
		$result = mysqli_query ($conn, $query);	
	}

}

$query = "SELECT * FROM contatos WHERE codigo=$codigo";
$result = mysqli_query ($conn, $query);
$row = mysqli_fetch_assoc ($result);

?>

<!DOCTYPE html>
<html lang="pt">

<head>
	  <meta http-equiv="content-type" content="text/html; charset=ISO8859-1">
    <meta charset="ISO8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- colocar aqui a referência ao ficheiro de estilos -->
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
          <form role="form" name="frmPesquisa" method="post" action="read.php">
            <input type="text" placeholder="Pesquisa" aria-label="Search" name="pesquisa">
            <button type="submit">Pesquisar</button>
          </form>

        </div>
      </nav>
      <!-- /.navbar -->
    </header>

    <main>     
      <div><!-- contentor -->   
        <legend>CR<strong>Update</strong>D</legend>
    </div>

    <div><!-- info -->
		<?php
		  	if($_SERVER["REQUEST_METHOD"] == "POST" AND $nomeErr =="" AND $emailErr == "") {
		?>
          <div >
            <h4>Info!</h4>
            <hr>
            Os dados foram atualizados com sucesso.
          </div>
        <?php
            }	
        ?>
		<?php if($nomeErr !="" OR $emailErr != "") { ?>
            <div">
			<h4>Alerta!</h4>
              <hr>
              <p><?PHP echo $nomeErr ?></p>
              <p><?PHP echo $emailErr ?></p> 
            </div>
        <?php }	?>
    </div><!-- /.info -->

    <div><!-- contentor do formulario --> 
        <form name="frmInserir" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div>
              <label for="nome">Nome </label>
              <div>
                <input name="nome" type="text" value="<?php echo $row['nome'];?>" placeholder="Nome"/>
              </div>
            </div>
            <div>
              <label for="email">Email </label>
              <div>
                <input name="email" type="email" value="<?php echo $row['email'];?>" placeholder="Email"/>
              </div>
            </div>
            <div>
              <div>
                <div>
					<input name="codigo" type="hidden" value="<?PHP echo $codigo; ?>" />
					<button name="alterar" type="submit" >Alterar</button>
					<button name="limpar" type="reset" >Limpar</button>
					<a href="read.php">Voltar &agrave; Lista</a>
                </div>
              </div>
            </div>
        </form>
      </div><!-- /.container -->

      <!-- footer -->
      <footer>
        <p>&copy; 2021 Jos&eacute; Monteiro</p>
      </footer>
      <!-- /.footer -->
    </main>	
	</body>
</html>
<?php
// fechar a ligação à base de dados
mysqli_close ($conn);

} else {
  header ('Location: login.php');
} 
?>