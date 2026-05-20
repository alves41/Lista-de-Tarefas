<?php 
$arquivo = __DIR__ . '/tarefas.json';

function lerTarefas($arquivo){
    if (!file_exists($arquivo)){
        return [];
    }
    $json = file_get_contents($arquivo);
    $resultado = json_decode($json, true);

    if ($resultado === null) {
        return [];
    } else {
        return $resultado;
    }
};

function salvarTarefa($arquivo, $tarefas){
    $json = json_encode($tarefas, JSON_PRETTY_PRINT);
    file_put_contents($arquivo, $json);
};

function criarTarefas($arquivo, $titulo){
    $tarefas = lerTarefas($arquivo);

    $tarefas[] = [
        'id' => uniqid(),
        'titulo'    => $titulo,
        'status'    => 'pendente',
        'criado_em' => date('d/m/Y H:i')
    ];

    salvarTarefa($arquivo, $tarefas);
};

function deletarTarefa($arquivo, $id){
    $tarefas = lerTarefas($arquivo);

    $novasTarefas = [];

    foreach($tarefas as $tarefa){

        if($tarefa['id'] != $id){
            $novasTarefas[] = $tarefa;
        }

    }

   salvarTarefa($arquivo, $novasTarefas);
};
?>