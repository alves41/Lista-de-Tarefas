<?php
require_once 'auth.php';
require_once 'tarefas.php';
require_once 'func.php';
$usuarios = lerUsuarios($arquivoUsuarios);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="script/tarefas.js"></script>
    <script src="script/script.js"></script>
    <title>Lista de Tarefas</title>
</head>

<body>
    <form method="POST">
    <button class="sair" type="submit" name="sair">
        <i class="fa-solid fa-person-walking-arrow-right"></i>
        Encerrar
    </button>
</form>

    <div class="container">
        <h1>Organize sua Rotina</h1>
        <form method="POST" class="form-criar">
            <input type="text" name="titulo" placeholder="Título para sua nova tarefa" class="CriarTarefa">
            <button type="submit" name="criar">Adicionar</button>
        </form>
        <div class="lista-tarefas">
            <?php foreach ($tarefasFiltradas as $tarefas) { ?>
                <div class="card <?php echo  $tarefas['status'] == 'CONCLUIDO' ? 'CONCLUIDO' : ''; ?>">
                    <h3><?php echo $tarefas['titulo']; ?></h3>
                    <div class="info">
                        <p class="status"><?php echo $tarefas['status']; ?></p>
                        <small class="data"><?php echo $tarefas['criado_em']; ?></small>
                    </div>
                    <div class="acoes">
                        <form method="POST" class="editar-form">
                            <input type="hidden" name="id" value="<?php echo $tarefas['id']; ?>">
                            <input type="text" name="novotitulo" placeholder="Novo título" class="AtualizarTarefa">
                            <div class="linha">
                                <label class="status-radio">
                                    <input type="radio" name="status" value="PENDENTE" 
                                    <?= $tarefas['status'] == 'PENDENTE' ? 'hecked' : '' ?>
                                    >
                                    <span>Pendente</span>
                                </label>
                                <label class="status-radio">
                                    <input type="radio" name="status" value="CONCLUIDO"
                                    <?= $tarefas['status'] == 'CONCLUIDO' ? 'checked' : '' ?>
                                    >
                                    <span>Concluído</span>
                                </label>
                            </div>
                            <div class="botoes">
                                <button class="salvar" type="submit" name="salvar">Salvar</button>
                                <button type="submit" name="deletar" class="btn-delete">Excluir</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>