<?php

session_start();
require_once 'func.php';

$arquivoUsuarios = __DIR__ . '/script//usuarios.json';
$usuarios = lerUsuarios($arquivoUsuarios);
$erro = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    if(empty($usuario) || empty($senha)){

        $erro = 'Preencha todos os campos';

    } else{
            $usuarioExiste = false;
            
            foreach($usuarios as $u){

                if($u['usuario'] === $usuario){                   
                    $usuarioExiste = true;
                    $erro = 'Usuário já existe';
                    break;
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
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/cadastro.css">
    <title>Cadastro</title>
</head>
<body>
     <form method="POST">
         <h1>Criar Conta</h1> 
         <input type="text" id="user" name="usuario" placeholder="Como quer ser chamado?" maxlength="8">
         <input type="password" id="password" name="senha" placeholder="Sua senha" maxlength="8">
         <button type="submit"> Cadastrar </button>
         <div class="erro"><?php echo $erro;?></div> 
         <small id="errouser" class="erro"></small>
         <a href="login.php"> Já tenho conta! </a>
    </form> 
    <script src="script/script.js"></script>
</body>
</html>
