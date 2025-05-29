<?php

require_once 'model/Administrador.php';
require_once 'dao/AdministradorDAO.php';
require_once 'config/conexao.php'; // Incluir a conexão aqui

class AdministradorController {
    private $administradorDAO;

    public function __construct() {
        // Conectar ao banco de dados e instanciar o DAO
        $conexao = Conexao::getConexao();
        $this->administradorDAO = new AdministradorDAO($conexao);
    }

    public function exibirFormularioLogin() {
        // Simplesmente carrega a view do formulário de login
        include 'view/ADMLogin.php';
    }

    public function processarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cpf = $_POST['cpf'] ?? '';
            $senha = $_POST['senha'] ?? '';

            // Validação básica dos campos
            if (empty($cpf) || empty($senha)) {
                $erro = "Por favor, preencha todos os campos.";
                include 'view/ADMLogin.php';
                return;
            }

            // Busca o administrador pelo CPF
            $administrador = $this->administradorDAO->buscarPorCpf($cpf);

            if ($administrador && $administrador->getSenha() === $senha) {
                // Login bem-sucedido
                // Iniciar sessão (se ainda não estiver iniciada)
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['administrador_logado'] = true;
                $_SESSION['administrador_id'] = $administrador->getIdadministrador();
                $_SESSION['administrador_nome'] = $administrador->getNome();

                // Redirecionar para o dashboard do administrador
                header('Location: index.php?action=dashboardAdmin');
                exit();
            } else {
                // Login falhou
                $erro = "CPF ou senha inválidos.";
                include 'view/ADMLogin.php'; // Recarrega a página de login com erro
            }
        } else {
            // Se não for POST, redireciona para o formulário de login
            header('Location: index.php?action=loginAdmin');
            exit();
        }
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Destrói todas as variáveis de sessão
        $_SESSION = array();
        // Destrói a sessão
        session_destroy();
        // Redireciona para a página de login
        header('Location: index.php?action=loginAdmin');
        exit();
    }

    public function exibirDashboardAdmin() {
        // Verifica se o administrador está logado
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['administrador_logado']) || $_SESSION['administrador_logado'] !== true) {
            header('Location: index.php?action=loginAdmin');
            exit();
        }
        // Carrega a view do dashboard
        include 'view/ADMDashboard.php';
    }

    // Você pode adicionar mais métodos aqui para gerenciar usuários, etc.
}

?>