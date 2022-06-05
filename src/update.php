<?php
//inicializar sess�o
session_start();
include ("assets/html/header.html");
// codifica��o de carateres
ini_set('default_charset', 'ISO8859-1');

if( $_SESSION['login'] == TRUE){

// estabelecer a liga��o � base de dados
include ("connect.php");

// inicializa��o de vari�veis
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

// verifica se foi inserido código
function test_input($dados) {
	$dados = trim($dados);
	$dados = stripslashes($dados);
	$dados = htmlspecialchars($dados);
	return $dados;
  }

if($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["nome"])) {
		$nomeErr = "<strong>N�o deve apagar o Nome existente.</strong> PF introduza um Nome v�lido!";
	} else {
		$nome = test_input($_POST["nome"]);
		// verifica se o nome contem carateres com ou sem assento e espaços
		if (!preg_match("/^[a-zA-Z-' ]*$/",$nome)) {
		  $nomeErr = "O Nome não deve conter cararteres especiais ou n�meros!";
		}
	}
	  
	if (empty($_POST["email"])) {
		$emailErr = "<strong>N�o deve apagar o Nome existente.</strong> PF digite um Email v�lido!";
	} else {
		$email = test_input($_POST["email"]);
		// verifica o formato do email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "O formato do Email � inv�lido.";
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
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>EXEMPLO PARA GEST&Atilde;O DA BASE DE DADOS</title>
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto">   
      <div><!-- contentor -->   
      <br><legend>CR<strong>Update</strong>D</legend><br>
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
    <br><br>
    <div><!-- contentor do formulario --> 
        <form name="frmInserir" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div>
              <label for="nome"><b>Nome</b></label>
              <div class="form-floating">
                <input name="nome" type="text" value="<?php echo $row['nome'];?>" placeholder="Nome"/>
              </div>
            </div>
            <div>
              <label for="email"><b>Email</b></label>
              <div class="form-floating">
                <input name="email" type="email" value="<?php echo $row['email'];?>" placeholder="Email"/>
              </div>
            </div>
            <br>
            <div>
              <div>
                <div>
					<input name="codigo" type="hidden" value="<?PHP echo $codigo; ?>" />
					<button class="btn btn-dark" name="alterar" type="submit">Alterar</button>
					<button class="btn btn-dark" name="limpar" type="reset">Reset</button>
					<button class="btn btn-dark"><a href="read.php" class="link-light">Voltar &agrave; Lista</a></button>
                </div>
              </div>
            </div>
        </form>
      </div><!-- /.container -->
      <br><br>
      <?php include ("assets/html/footer.html"); ?>
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