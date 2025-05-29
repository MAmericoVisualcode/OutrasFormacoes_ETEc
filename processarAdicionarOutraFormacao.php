<?php
if(!isset($_SESSION)) {
    session_start();
}

require_once 'controller/OutrasFormacoesController.php';
// Não precisamos do model OutrasFormacoes aqui, pois o controller já lida com isso.
// require_once 'model/OutrasFormacoes.php'; // Removido ou comentado, não é estritamente necessário aqui

header('Content-Type: text/plain'); // Retorna texto puro (sucesso/erro/ID)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idusuario = filter_input(INPUT_POST, 'idusuario', FILTER_VALIDATE_INT);
    $inicio = filter_input(INPUT_POST, 'inicio', FILTER_SANITIZE_STRING);
    $fim = filter_input(INPUT_POST, 'fim', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);

    if ($idusuario && $inicio && $fim && $descricao) {
        $outrasFormacoesController = new OutrasFormacoesController();
        // O método inserir no DAO já retorna o ID do último insert, e o Controller repassa isso.
        $novoId = $outrasFormacoesController->inserir($idusuario, $inicio, $fim, $descricao);

        if ($novoId !== false) { // Verifica se a inserção foi bem-sucedida e retornou um ID (não false)
            echo $novoId; // Imprime o ID do novo registro para o JavaScript
        } else {
            echo "erro_inserir"; // Mensagem de erro caso a inserção no DB falhe
        }
    } else {
        echo "dados_invalidos"; // Mensagem de erro caso os dados POST estejam incompletos ou inválidos
    }
} else {
    echo "requisicao_invalida"; // Mensagem de erro caso a requisição não seja POST
}
?>