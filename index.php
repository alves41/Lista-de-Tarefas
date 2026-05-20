<?php

require_once 'tarefas.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['criar'])) {

        $titulo = $_POST['titulo'];

        if ($titulo != '') {
            criarTarefas($arquivo, $titulo);
        }
    }

    if (isset($_POST['deletar'])) {

        $id = $_POST['id'];

        deletarTarefa($arquivo, $id);
    }
}

$tarefas = lerTarefas($arquivo);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
<meta charset="UTF-8">
<meta name="viewport"content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="estilo.css">
<script src="script.js"></script>
<title>Lista de Tarefas</title>
</head>

<body>

    <div class="container">

        <h1>Lista de Tarefas</h1>

        <form method="POST" class="form-criar">

            <input
                type="text"
                name="titulo"
                placeholder="Digite uma tarefa">

            <button
                type="submit"
                name="criar">
                Adicionar
            </button>

        </form>

        <?php foreach ($tarefas as $tarefa) { ?>

            <div class="card <?php echo $tarefa['status'] == 'concluido' ? 'concluido' : ''; ?>">

                <h3>
                    <?php echo $tarefa['titulo']; ?>
                </h3>

                <p class="status">
                    Status: <?php echo $tarefa['status']; ?>
                </p>

                <small>
                    Criado em: <?php echo $tarefa['criado_em']; ?>
                </small>

                <div class="acoes">

                    <form method="POST" class="linha">

                        <input
                            type="hidden"
                            name="id"
                            value="<?php echo $tarefa['id']; ?>">

                        <input
                            type="text"
                            name="novo_titulo"
                            placeholder="Novo título">

                        <button
                            type="submit"
                            name="editar">
                            Editar
                        </button>

                    </form>

                    <form method="POST" class="linha">

                        <input
                            type="hidden"
                            name="id"
                            value="<?php echo $tarefa['id']; ?>">

                        <select name="status">

                            <option value="pendente">
                                Pendente
                            </option>

                            <option value="concluido">
                                Concluído
                            </option>

                        </select>

                        <button
                            type="submit"
                            name="atualizar_status">
                            Atualizar
                        </button>

                    </form>

                    <form method="POST">

                        <input
                            type="hidden"
                            name="id"
                            value="<?php echo $tarefa['id']; ?>">

                        <button
                            type="submit"
                            name="deletar"
                            class="btn-delete">
                            Deletar
                        </button>

                    </form>

                </div>

            </div>

        <?php } ?>

    </div>
</body>
</html>