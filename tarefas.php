<?php
require_once 'func.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['criar'])) {

        $usuarioLogado = $_SESSION['usuario_logado'];
        $titulo = trim($_POST['titulo']);
        $status = 'PENDENTE';
        $tarefas = lerTarefas($arquivo);
        $existe = false;

        foreach ($tarefas as $tarefa) {

            if ($titulo == $tarefa['titulo']) {
                $existe = true;
            }
        }

        if ($titulo != '' && !$existe) {

            criarTarefas($arquivo, $titulo, $status);
        }
    }

    if (isset($_POST['salvar'])) {

        $id = $_POST['id'];
        $novotitulo = trim($_POST['novotitulo']);
        $status = $_POST['status'];
        atualizarTarefa($arquivo, $id, $novotitulo, $status);
    }

    if (isset($_POST['deletar'])) {

        $id = $_POST['id'];
        deletarTarefa($arquivo, $id);
    }
}

$tarefas = lerTarefas($arquivo);
$tarefasFiltradas = [];

foreach($tarefas as $tarefinhas){

    if($tarefinhas['usuario'] === $_SESSION['usuario_logado']){

        $tarefasFiltradas [] = $tarefinhas;

    }

}

?>