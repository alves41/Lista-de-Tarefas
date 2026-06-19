<?php

$arquivoUsuarios = __DIR__ . '/usuarios.json';

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