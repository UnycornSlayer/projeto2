<?php
//inicializar sessão
session_start();

// codificação de carateres
ini_set('default_charset', 'ISO8859-1');

if( $_SESSION['login'] == TRUE){

    // estabelecer a ligação à base de dados
    include ("connect.php");
    $query = "DELETE FROM contatos WHERE codigo=$_GET[codigo]";
    mysqli_query ($conn, $query);
    // fechar a ligação à base de dados
    mysqli_close ($conn);
    // redireccionar para a página principal
    header("location: read.php");

} else {
    header ('Location: login.php');
  } 
?>