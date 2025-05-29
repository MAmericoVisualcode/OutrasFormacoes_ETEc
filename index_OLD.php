<?php

require_once 'controller/UsuarioController.php';
require_once 'controller/AdministradorController.php'; // Adicione esta linha

// Instanciar controllers
$usuarioController = new UsuarioController();
$administradorController = new AdministradorController(); // Adicione esta linha

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
        // --- Novas ações para o Administrador ---
        case 'loginAdmin': // Exibe o formulário de login do administrador
            $administradorController->exibirFormularioLogin();
            break;
        case 'processarLoginAdmin': // Processa a submissão do formulário de login
            $administradorController->processarLogin();
            break;
        case 'dashboardAdmin': // Exibe o dashboard do administrador (após login)
            $administradorController->exibirDashboardAdmin();
            break;
        case 'logoutAdmin': // Realiza o logout do administrador
            $administradorController->logout();
            break;
        // ----------------------------------------
        default:
            echo "Ação inválida.";
            break;
    }
} else {
    // Ação padrão se nenhum parâmetro 'action' for fornecido
    $usuarioController->listarUsuarios();
}

?>