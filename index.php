<?php
if(!isset($_SESSION))
{
    session_start();
}

// Inclusão dos Controllers (ajuste os caminhos conforme necessário)
require_once 'controller/UsuarioController.php';
require_once 'controller/AdministradorController.php';
require_once 'controller/FormacaoAcademicaController.php';
require_once 'controller/ExperienciaProfissionalController.php';
require_once 'controller/OutrasFormacoesController.php';

$usuarioController = new UsuarioController();
$administradorController = new AdministradorController();
$formacaoController = new FormacaoAcademicaController();
$experienciaController = new ExperienciaProfissionalController();
$outrasFormacoesController = new OutrasFormacoesController();

// Variável para armazenar a ação a ser executada
$action = $_GET['action'] ?? 'home'; // Padrão: 'home'

// Lógica de roteamento
switch ($action) {
    // --- Ações de Login/Logout ---
    case 'loginUsuario':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            if ($usuarioController->login($email, $senha)) {
                header('Location: index.php?action=dashboardUsuario'); // Redireciona para o dashboard do usuário
                exit();
            } else {
                $mensagemErro = "Email ou senha de usuário incorretos.";
                include 'view/login.php'; // Inclui a view de login novamente com a mensagem de erro
            }
        } else {
            include 'view/login.php'; // Exibe a view de login pela primeira vez
        }
        break;

    case 'logoutUsuario':
        $usuarioController->logout();
        header('Location: index.php?action=loginUsuario');
        exit();
        break;

    case 'loginAdmin':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            if ($administradorController->login($email, $senha)) {
                header('Location: index.php?action=dashboardAdmin'); // Redireciona para o dashboard do admin
                exit();
            } else {
                $mensagemErro = "Email ou senha de administrador incorretos.";
                include 'view/loginAdmin.php'; // Supondo que você tenha uma view de login do admin
            }
        } else {
            include 'view/loginAdmin.php'; // Supondo que você tenha uma view de login do admin
        }
        break;

    case 'logoutAdmin':
        $administradorController->logout();
        header('Location: index.php?action=loginAdmin');
        exit();
        break;

    // --- Ações de Primeiro Acesso / Cadastro de Usuário ---
    case 'primeiroAcesso':
        // Apenas exibe o formulário de cadastro
        $mensagem = ''; // Inicia a mensagem vazia
        include 'view/primeiroAcesso.php';
        break;

    case 'cadastrarUsuario':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'txtNome', FILTER_SANITIZE_STRING);
            $cpf = filter_input(INPUT_POST, 'txtCpf', FILTER_SANITIZE_STRING);
            $dataNascimento = filter_input(INPUT_POST, 'txtDataNascimento', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_EMAIL);
            $senha = filter_input(INPUT_POST, 'txtSenha', FILTER_SANITIZE_STRING);
            $confirmarSenha = filter_input(INPUT_POST, 'txtConfirmarSenha', FILTER_SANITIZE_STRING);

            $mensagem = $usuarioController->cadastrarUsuario($nome, $cpf, $dataNascimento, $email, $senha, $confirmarSenha);
            include 'view/primeiroAcesso.php'; // Exibe a mesma view com a mensagem de retorno
        } else {
            header('Location: index.php?action=primeiroAcesso'); // Redireciona para o formulário se não for POST
            exit();
        }
        break;

    // --- Ações do Administrador ---
    case 'dashboardAdmin':
        // Verifica se o administrador está logado
        if (!isset($_SESSION['administrador_logado']) || $_SESSION['administrador_logado'] !== true) {
            header('Location: index.php?action=loginAdmin');
            exit();
        }
        include 'view/ADMDashboard.php';
        break;

    case 'listarUsuarios':
        // Verifica se o administrador está logado
        if (!isset($_SESSION['administrador_logado']) || $_SESSION['administrador_logado'] !== true) {
            header('Location: index.php?action=loginAdmin');
            exit();
        }
        $usuarios = $usuarioController->listarUsuarios(); // Obtém a lista de usuários
        include 'view/ADMListarCadastrados.php';
        break;

    case 'visualizarCadastro':
        // Verifica se o administrador está logado
        if (!isset($_SESSION['administrador_logado']) || $_SESSION['administrador_logado'] !== true) {
            header('Location: index.php?action=loginAdmin');
            exit();
        }
        $idUsuario = $_GET['id'] ?? null;
        if ($idUsuario) {
            $usuario = $usuarioController->buscarPorId($idUsuario);
            $outrasFormacoes = $outrasFormacoesController->listarPorUsuario($idUsuario); // Lista as outras formações
            // Você pode adicionar aqui as experiências e formações acadêmicas também, se quiser exibir tudo em uma única tela de visualização.
            // $experiencias = $experienciaController->listarPorUsuario($idUsuario);
            // $formacoesAcademicas = $formacaoController->listarPorUsuario($idUsuario);
            include 'view/ADMVisualizarCadastro.php';
        } else {
            header('Location: index.php?action=listarUsuarios'); // Redireciona se não houver ID
            exit();
        }
        break;

    // --- Ações do Usuário Comum ---
    case 'dashboardUsuario':
        // Verifica se o usuário está logado
        if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
            header('Location: index.php?action=loginUsuario');
            exit();
        }
        // Você pode exibir um dashboard mais completo aqui ou apenas uma mensagem de boas-vindas
        echo "<h1>Bem-vindo ao Dashboard do Usuário!</h1>";
        echo "<p><a href='index.php?action=gerenciarFormacaoAcademica'>Gerenciar Formação Acadêmica</a></p>";
        echo "<p><a href='index.php?action=gerenciarExperienciaProfissional'>Gerenciar Experiência Profissional</a></p>";
        echo "<p><a href='index.php?action=logoutUsuario'>Sair</a></p>";
        break;

    case 'gerenciarFormacaoAcademica':
        if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true || !isset($_SESSION['idusuario'])) {
            header('Location: index.php?action=loginUsuario');
            exit();
        }
        include 'view/formacaoAcademica.php';
        break;

    case 'gerenciarExperienciaProfissional':
        if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true || !isset($_SESSION['idusuario'])) {
            header('Location: index.php?action=loginUsuario');
            exit();
        }
        include 'view/experienciaProfissional.php';
        break;

    // --- Página Inicial Padrão ---
    case 'home':
    default:
        // Se ninguém está logado, mostra a tela de login principal (usuário)
        if (isset($_SESSION['administrador_logado']) && $_SESSION['administrador_logado'] === true) {
            header('Location: index.php?action=dashboardAdmin');
            exit();
        } elseif (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] === true) {
             header('Location: index.php?action=dashboardUsuario');
             exit();
        } else {
            include 'view/login.php'; // Default para login de usuário se não houver sessão ativa
        }
        break;
}
?>
