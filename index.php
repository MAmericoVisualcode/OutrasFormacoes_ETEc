<?php

require_once 'controller/UsuarioController.php';

$usuarioController = new UsuarioController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'listarUsuarios':
        case '': // Ação padrão (página inicial) também lista os usuários
            $usuarioController->listarUsuarios();
            break;
        case 'cadastro':
            $usuarioController->exibirFormularioCadastro();
            break;
        case 'processarCadastro':
            $usuarioController->processarCadastro();
            break;
        case 'detalhes':
            if (isset($_GET['id'])) {
                $usuarioController->exibirDetalhesUsuario($_GET['id']);
            } else {
                echo "ID do usuário não especificado.";
            }
            break;
        case 'visualizarCadastro':
            if (isset($_GET['id'])) {
                $usuarioController->exibirVisualizarCadastro($_GET['id']);
            } else {
                echo "ID do usuário não especificado para visualização.";
            }
            break;
        case 'processarAdicionarOutraFormacao':
            $usuarioController->processarAdicionarOutraFormacao();
            break;
        case 'processarApagarOutraFormacao':
            $usuarioController->processarApagarOutraFormacao();
            break;
        // Adicione outras ações do Controller aqui, conforme necessário
        default:
            echo "Ação inválida.";
            break;
    }
} else {
    // Ação padrão se nenhum parâmetro 'action' for fornecido
    $usuarioController->listarUsuarios();
}

?>