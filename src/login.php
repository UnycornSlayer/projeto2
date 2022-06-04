<?php
//inicializar sessão
session_start();

// codificação de carateres
ini_set('default_charset', 'ISO8859-1');

// inicialização de variáveis
$passwordErr = $emailErr = $autErr = "";
$password = $email = "";

// estabelecer a ligação à base de dados
include ("connect.php");

// verifica se foi inserido código
function test_input($dados) {
	$dados = trim($dados);
	$dados = stripslashes($dados);
	$dados = htmlspecialchars($dados);
	return $dados;
  }

if( !empty( $_SESSION['login'] )){
    header ('Location: index.php');
} else {

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["email"])) {
      $emailErr = "PF digite o Email!";
    } else {
      $email = test_input($_POST["email"]);
      // verifica o formato do email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "O formato do Email é inválido.";
      }
    }

    if (empty($_POST["password"])) {
      $nomeErr = "PF digite a password!";
    } else {
      $nome = test_input($_POST["password"]);
    }
    
    if ($passwordErr =="" AND $emailErr == ""){
      $query = "SELECT * FROM contatos WHERE email='$_POST[email]' AND  password='$_POST[password]'";
      $result = mysqli_query ($conn,$query);
      $row = mysqli_fetch_assoc ($result);
      if (mysqli_num_rows($result) > 0){
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['login'] = TRUE;
        header ('Location: index.php');
      } else {
        $autErr ="PF verifique os dados de autenticação";
      }
  
    }
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
    <!-- Bootstrap core CSS -->
    <link href="bootstrap413/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap413/css/signin.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .form-signin {
        width: 100%;
        max-width: 400px;
        padding: 15px;
        margin: auto;
      }
      
    </style>

    <title>EXEMPLO PARA GEST&Atilde;O DA BASE DE DADOS</title>  
  </head>

  <body>
    <main>

      <!-- info -->
      <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" AND ($passwordErr !="" OR $emailErr != "" OR $autErr !="")) {
      ?>
      <div>
        <h4>Alerta!</h4>
        <hr>
        <?php
          echo $autErr;
          echo $emailErr;
          echo $passwordErr;
        ?>
      </div>
      <?php } ?><!-- /.info -->

      <form name="frmLogin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">          
          <h1>Autentica&ccedil;&atilde;o</h1>
          <input type="email" name="email"  placeholder="Email" value="<?php echo $email; ?>" required autofocus>
          </div>
          <input type="password" name="password" placeholder="Password" required>
          <div>
          <label>
              <input type="checkbox" value="remember-me"> Memorizar
          </label>
          </div>
          <button type="submit">Entrar</button>
          <p>&copy; Jos&eacute; Monteiro 2021</p>
      </form>
    </main>

  </body>
</html>
<?php
  mysqli_close($conn);
?>