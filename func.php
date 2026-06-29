<?php

date_default_timezone_set('America/Sao_Paulo');
$arquivo = __DIR__ . '/script/tarefas.json';

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
        'usuario' => $_SESSION['usuario_logado'],
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

$arquivoUsuarios = __DIR__ . '/script/usuarios.json';

function lerUsuarios($arquivo){

    if(!file_exists($arquivo)){
        return [];
    }

    $json = file_get_contents($arquivo);

    $resultado = json_decode($json, true);

    if($resultado === null){
    return [];
    }

    return $resultado;
}

function salvarUsuarios($arquivo, $usuarios){

$json = json_encode($usuarios,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

file_put_contents($arquivo,$json);

}
?>