<?php
session_start();

if (!isset($_SESSION['usuario_logado'])){
    header('Location: login.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    if(isset($_POST['sair'])){
        session_destroy();
        header('Location: login.php');
        exit;
    }
}

?>