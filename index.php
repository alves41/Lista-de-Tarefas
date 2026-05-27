<?php
require_once 'tarefas.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <script src="script.js"></script>
    <title>Lista de Tarefas</title>
</head>
<body>
    <div class="container">
        <h1>Organize sua Rotina</h1>
        <form method="POST" class="form-criar">
            <input type="text" name="titulo" placeholder="Título para sua nova tarefa" class="CriarTarefa">
            <button type="submit" name="criar">Adicionar</button>
        </form>
        <div class="lista-tarefas">
            <?php foreach ($tarefas as $tarefa) { ?>
                <div class="card <?php echo $tarefa['status'] == 'CONCLUIDO' ? 'CONCLUIDO' : ''; ?>">
                    <h3><?php echo $tarefa['titulo']; ?></h3>
                    <div class="info">
                        <p class="status"><?php echo $tarefa['status']; ?></p>
                        <small class="data"><?php echo $tarefa['criado_em']; ?></small>
                    </div>
                    <div class="acoes">
                        <form method="POST" class="editar-form">
                            <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
                            <input type="text" name="novotitulo" placeholder="Novo título" class="AtualizarTarefa">
                            <div class="linha">
                                <label class="status-radio">
                                    <input type="radio" name="status" value="PENDENTE" 
                                    <?= $tarefa['status'] == 'PENDENTE' ? 'checked' : '' ?>
                                    >
                                    <span>Pendente</span>
                                </label>
                                <label class="status-radio">
                                    <input type="radio" name="status" value="CONCLUIDO"
                                    <?= $tarefa['status'] == 'CONCLUIDO' ? 'checked' : '' ?>
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