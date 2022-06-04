<?php
//inicializar sessão
session_start();

// codificação de carateres
ini_set('default_charset', 'ISO8859-1');

if( $_SESSION['login'] == TRUE){

   // limpa as variáveis da sessão
    session_unset();
    
    // remove a sessão
    session_destroy();

}

header ('Location: login.php');
?>