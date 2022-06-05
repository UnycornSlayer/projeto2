<?php
//inicializar sess�o
session_start();
include ("header.html");
// codifica��o de carateres
ini_set('default_charset', 'ISO8859-1');

if( $_SESSION['login'] == TRUE){

// estabelecer a liga��o � base de dados
include ("connect.php");


// inicializa��o de vari�veis
$nomeErr = $emailErr = $passwordErr= "";
$nome = $email = $password = $hidden = $disabled = "";

// verifica se foi inserido c?digo
function test_input($dados) {
	$dados = trim($dados);
	$dados = stripslashes($dados);
	$dados = htmlspecialchars($dados);
	return $dados;
  }

if($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["nome"])) {
		$nomeErr = "PF digite o Nome!";
	  } else {
      $nome = test_input($_POST["nome"]);
      // verifica se o nome contem carateres com ou sem assento e espa�os
      if (!preg_match("/^[a-zA-Z-' ]*$/",$nome)) {
        $nomeErr = "O Nome n�o deve conter cararteres especiais ou n�meros.";
      }
	  }
	  
	  if (empty($_POST["email"])) {
		$emailErr = "PF digite o Email!";
	  } else {
      $email = test_input($_POST["email"]);
      // verifica o formato do email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "O formato do Email � inv�lido.";
      }
    }

    
    if (strlen($_POST["password"]) < 5) {    
      $passwordErr = "A password deve ter pelo menos 5 carateres";
      } elseif ($_POST["password"] != $_POST["rpassword"]){
        $passwordErr = "As passwords n�o coincidem. PF introduza novamente as passwords.";
        } else { 
          $password = test_input($_POST["password"]);
      }

	if ($nomeErr =="" AND $emailErr == "" AND $passwordErr == ""){
		$query = "INSERT INTO contatos (nome, email, password)
		VALUES ('$nome',  '$email', '$password')";
    mysqli_query ($conn,$query);
    $disabled = "disabled";
    $hidden = "hidden";
	}
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
    <!-- colocar aqui a referência ao ficheiro de estilos -->
    <link href="" rel="stylesheet">
    <title>EXEMPLO PARA GEST&Atilde;O DA BASE DE DADOS</title>
  </head>

  <body>


    <main>

      <div> <!-- titulo -->
        <legend><strong>Create</strong>RUD</legend>
      </div>

      <div><!-- info -->
        <?php
          if($_SERVER["REQUEST_METHOD"] == "POST" AND $nomeErr =="" AND $emailErr == "" AND $passwordErr =="") {
        ?>
          <div>
            <h4 >Info!</h4>
            <hr>
            Os dados foram inseridos com sucesso.
          </div>
        <?php
            }	
        ?>
        <?php if($nomeErr !="" OR $emailErr != "" OR $passwordErr !="") { ?>
          <div>
              <h4>Alerta!</h4>
              <hr>
              <p><?PHP echo $nomeErr ?></p>
              <p><?PHP echo $emailErr ?></p>
              <p><?PHP echo $passwordErr ?></p>
          </div>
        <?php }	?>
      </div><!-- /.info -->

      <div><!-- contentor do formulario --> 
        <form name="frmInserir" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div>
              <label>Nome </label>
              <div >
                <input name="nome" type="text" value="<?php echo $nome;?>" placeholder="Nome" <?php echo $disabled ?>>
              </div>
            </div>
            <div>
              <label>Email </label>
              <div>
                <input name="email" type="email" value="<?php echo $email;?>" placeholder="Email" <?php echo $disabled ?>>
              </div>
            </div>
            <div <?php echo $hidden ?>>
              <label>Password </label>
              <div>
                <input name="password" type="password" placeholder="Password [min. 5 caracteres]"/>
              </div>
            </div>
            <div <?php echo $hidden ?>>
              <label>Repetir password </label>
              <div>
                <input name="rpassword" type="password" placeholder="Pepetir a password"/>
              </div>
            </div>
            <div>
              <div>
                <div>	
                  <button name="gravar" type="submit" <?php echo $disabled ?>>Gravar</button>
                  <button name="limpar" type="reset" >Limpar</button>
                  <a href="read.php">Voltar &agrave; Lista</a>
                </div>
              </div>
            </div>
        </form>
      </div><!-- /.container -->

      <?php include ("footer.html"); ?>
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