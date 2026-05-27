<?php
date_default_timezone_set('America/Sao_Paulo');

$arquivo = __DIR__ . '/tarefas.json';

function lerTarefas($arquivo){

    if (!file_exists($arquivo)){
        return [];
    }

    $json = file_get_contents($arquivo);
    $resultado = json_decode($json, true);

    if ($resultado === null) {
        return [];
    }

    return $resultado;
}

function salvarTarefa($arquivo, $tarefas){

    $json = json_encode($tarefas, JSON_PRETTY_PRINT);
    file_put_contents($arquivo, $json);
}

function criarTarefas($arquivo, $titulo, $status){

    $tarefas = lerTarefas($arquivo);

    $tarefas[] = [
        'id' => uniqid(),
        'titulo' => $titulo,
        'status' => $status,
        'criado_em' => date('d/m/Y H:i')
    ];

    salvarTarefa($arquivo, $tarefas);
}

function deletarTarefa($arquivo, $id){

    $tarefas = lerTarefas($arquivo);
    $novasTarefas = [];

    foreach($tarefas as $tarefa){

        if($tarefa['id'] != $id){
            $novasTarefas[] = $tarefa;
        }
    }

    salvarTarefa($arquivo, $novasTarefas);
}

function atualizarTarefa($arquivo, $id, $novotitulo, $status){

    $tarefas = lerTarefas($arquivo);

    foreach($tarefas as $indice => $tarefa){

        if($tarefa['id'] == $id){

            if($novotitulo != ''){
                $tarefas[$indice]['titulo'] = $novotitulo;
            }
            $tarefas[$indice]['status'] = $status;
        }
    }

    salvarTarefa($arquivo, $tarefas);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['criar'])) {

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

?>