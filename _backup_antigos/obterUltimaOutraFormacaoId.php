<?php
if(!isset($_SESSION)) {
    session_start();
}

require_once 'controller/OutrasFormacoesController.php';
require_once 'model/OutrasFormacoes.php'; // Para usar o objeto OutrasFormacoes

header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $idusuario = filter_input(INPUT_GET, 'idusuario', FILTER_VALIDATE_INT);

    if ($idusuario) {
        $outrasFormacoesController = new OutrasFormacoesController();
        // A forma de obter o último ID inserido via DAO é um pouco complexa sem retornar o objeto
        // A melhor abordagem é ter o DAO retornar o objeto completo com o ID, ou o ID.
        // Como nosso DAO está retornando um boolean, vamos listar todas e pegar a última (menos eficiente, mas funcional para este caso)
        $formacoes = $outrasFormacoesController->listarPorUsuario($idusuario);
        if (!empty($formacoes)) {
            // Assumimos que o último é o recém-inserido se for ordenada por ID descendente no DAO
            // Melhor seria que o DAO->inserir retornasse o ID
            $ultimaFormacao = reset($formacoes); // Pega o primeiro elemento se ordenado por ID DESC
            echo $ultimaFormacao->getIdoutrasformacoes();
        } else {
            echo "nenhum_id_encontrado";
        }
    } else {
        echo "idusuario_invalido";
    }
} else {
    echo "requisicao_invalida";
}
?>