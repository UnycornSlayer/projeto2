<?php
//inicializar sess�o
session_start();

// codifica��o de carateres
ini_set('default_charset', 'ISO8859-1');
include ("assets/html/header.php");
include ("connect.php");

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
    <title></title>
  </head>
  <body class="text-center">
 
  <?php
         $conn = mysqli_connect("localhost", "root", "", "geredb");
          
         // Check connection
         if($conn === false){
             die("ERROR: Could not connect. " 
                 . mysqli_connect_error());
         }
        $comentario =  $_POST['comentario'];
        $nome=$_SESSION['nome'];
        $sql = "INSERT INTO comentarios VALUES (NULL, '$nome', '$comentario')";
          
        if(mysqli_query($conn, $sql)){
            echo "<br><br><h3>Submited with success!</h3>"; 
        } else{
            echo "ERROR: $sql. " 
                . mysqli_error($conn);
        }
        // Close connection
        mysqli_close($conn);
        ?>


<br>
<button class="btn btn-dark link-light"><a href="comments.php" class="link-light">Ver todos os comentarios</a></button>

<br><br>
    <?php include ("assets/html/footer.html"); ?>
</body>
</html>
<?php 
} else {
  header ('Location: login.php');
} 
?>