<?php
session_start();
echo "DEPLOY OK " . time();
require_once 'func.php';
$arquivoUsuarios = __DIR__ . '/usuarios.json';

$usuarios = lerUsuarios($arquivoUsuarios);
$erro = '';
$msg = '';
$usuarioEncontrado = false;
$senhaEncontrada = false;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
     $usuario =  trim($_POST['usuario']);
     $senha   =  trim($_POST['senha']);

     if(empty($usuario) || empty($senha)){
         $erro = 'Preencha todos os campos';
     }else {

        foreach($usuarios as $u){

            if($u['usuario'] === $usuario ){
                $usuarioEncontrado = true;

                if(password_verify($senha, $u['senha'])){
                    $senhaEncontrada = true;
                    $_SESSION['usuario_logado'] = $u['id'];
                    header('Location: index.php');
                    exit;
                }
                
            } 
     }

    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="estilo/login.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">🔐</div>
            <h1>Login</h1>
            <p class="subtitle">Acesse sua conta para continuar</p>

            <form method="POST">
                <input type="text" name="usuario" placeholder="Seu apelido" required>
                <input type="password" name="senha" placeholder="Sua senha" required>
                <button type="submit">Entrar</button>
            </form>

            <div class="criar-conta">
                <a href="cadastro.php">Criar conta</a>
            </div>
        </div>
    </div>
</body>
</html>
