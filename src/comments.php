<?php
//inicializar sess�o
session_start();

// codifica��o de carateres

include ("assets/html/header.php");
include ("connect.php");

if( $_SESSION['login'] == TRUE){
?>
<!DOCTYPE html>
<html lang="pt">

  <head>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css"/>
    <!-- colocar aqui a refer�ncia ao ficheiro de estilos -->
    <title>Comentários</title>
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
  </head>
  <body class="text-center">

  <h4>All comments</h4><br>

  <div class="container-fluid">
                            <div class="row">
                                <div class="col-9">
                                    <div class="row">
                                            <?php
                                            $conn = mysqli_connect("localhost", "root", "", "geredb");
                                            if ($conn-> connect_error){
                                                   die("Connection failed:". $conn-> connect_error);
                                            }

                                            $sql= "SELECT * FROM comentarios" ;
                                            $result= $conn-> query($sql);
                                            while ($row= $result-> fetch_assoc()){
                                                
                                            $id=$row['id'];
                                                echo '<div class="col-sm-6 text-center">';											 
                                                echo '<br><b>', $row["comentario"], '</b>';
                                                echo "<br>";
                                                  echo "<p>", $row["nome"], "</p>";
                                                echo '</div>';
                                            }		
                                            $conn-> close();										 
                                            ?>
                                        

                                        
                                    </div>
                                    
                                </div>

<br><br>
    <?php include ("assets/html/footer.html"); ?>
</body>
</html>
<?php 
} else {
  header ('Location: login.php');
} 
?>