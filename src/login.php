<?php
//inicializar sess�o
session_start();

// codifica��o de carateres


// inicializa��o de vari�veis
$passwordErr = $emailErr = $autErr = "";
$password = $email = "";

// estabelecer a liga��o � base de dados
include ("connect.php");

// verifica se foi inserido c�digo
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
        $emailErr = "O formato do Email � inv�lido.";
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
  <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
  
    <link rel="stylesheet" href="assets/css/login.css">

   

    <title>EXEMPLO PARA GEST&Atilde;O DA BASE DE DADOS</title>  
  </head>

  <body>
  
    <main>
      <!-- info -->
      <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" AND ($passwordErr !="" OR $emailErr != "" OR $autErr !="")) {
      ?>
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">ERROR!</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php
          echo $autErr;
          echo $emailErr;
          echo $passwordErr;
          ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-lg" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <script>  
        jQuery.noConflict();
        jQuery(function($) {
        $('#exampleModal').modal('show');
        });
      </script>
      
      <?php } ?>

      <!-- Modal -->
      



      <div class="main align-items-center">

          <form  name="frmLogin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <h3>Log in</h3>

            <div class="form-outline">
              <input type="email" name="email" class="form-control form-control-lg"/>
              <label class="form-label">Email address</label>
            </div>

            <div class="form-outline">
              <input type="password" name="password" class="form-control form-control-lg" />
              <label class="form-label">Password</label>
            </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-lg" type="submit">Login</button>
            </div>

          </form>

        </div>
    </main>
    <script src = "../node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>
  </body>

</html>
<?php
  mysqli_close($conn);
?>