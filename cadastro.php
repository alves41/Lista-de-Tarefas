<?php

session_start();
require_once 'func.php';

$arquivoUsuarios = __DIR__ . '/usuarios.json';
$usuarios = lerUsuarios($arquivoUsuarios);
$erro = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    if(empty($usuario) || empty($senha)){

        $erro = 'Preencha todos os campos';

    }else{

        $usuarioExiste = false;

        foreach($usuarios as $u){

            if($u['usuario'] === $usuario){
                $usuarioExiste = true;
                break;
            }
        }

        if($usuarioExiste){

            $erro = 'Usuário já existe';

        }else{

            $novoUsuario = [
                'id' => time(),
                'usuario' => $usuario,
                'senha' => password_hash($senha, PASSWORD_DEFAULT)
            ];

            $usuarios[] = $novoUsuario;

            salvarUsuarios($arquivoUsuarios, $usuarios);

            header('Location: login.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <<link rel="stylesheet" href="estilo/cadastro.css">
    <title>Cadastro</title>
</head>
<body>
     <form method="POST">
         <h1>Criar Conta</h1> 
         <input type="text" name="usuario" placeholder="Como quer ser chamado?" required>
         <input type="password" name="senha" placeholder="Sua senha" required>
         <button type="submit"> Cadastrar </button> 
         <a href="login.php"> Já tenho conta! </a>
    </form> 
</body>
</html>
