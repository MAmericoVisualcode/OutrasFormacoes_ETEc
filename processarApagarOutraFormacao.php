<?php
if(!isset($_SESSION)) {
    session_start();
}

require_once 'controller/OutrasFormacoesController.php';

header('Content-Type: text/plain'); // Retorna texto puro (sucesso/erro)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idoutrasformacoes = filter_input(INPUT_POST, 'idoutrasformacoes', FILTER_VALIDATE_INT);

    if ($idoutrasformacoes) {
        $outrasFormacoesController = new OutrasFormacoesController();
        if ($outrasFormacoesController->remover($idoutrasformacoes)) {
            echo "sucesso";
        } else {
            echo "erro_excluir";
        }
    } else {
        echo "id_invalido";
    }
} else {
    echo "requisicao_invalida";
}
?>