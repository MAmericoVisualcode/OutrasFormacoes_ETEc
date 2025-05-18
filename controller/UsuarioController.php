<?php

require_once '../model/Usuario.php';
require_once '../model/OutrasFormacoes.php';
require_once '../dao/OutrasFormacoesDAO.php';

class UsuarioController {

    public function listarUsuarios() {
        $usuarios = Usuario::listarTodos();
        // Agora, em vez de apenas imprimir, vamos incluir a View e passar os dados
        include '../view/ADMListarCadastrados.php';
    }

    public function exibirFormularioCadastro() {
        echo "<h2>Formulário de Cadastro de Usuário</h2>";
        echo "<form method='POST' action='processarCadastro'>";
        echo "Nome: <input type='text' name='nome'><br>";
        echo "CPF: <input type='text' name='cpf'><br>";
        echo "Data de Nascimento: <input type='date' name='datanascimento'><br>";
        echo "Email: <input type='email' name='email'><br>";
        echo "Senha: <input type='password' name='senha'><br>";
        echo "<input type='submit' value='Cadastrar'>";
        echo "</form>";
    }

    public function processarCadastro() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $datanascimento = $_POST['datanascimento'];
            $email = $_POST['email'];
            $senha = $_POST['senha']; // Em produção, lembre-se de hashear a senha!

            $novoUsuario = new Usuario(null, $nome, $cpf, $datanascimento, $email, $senha);
            if ($novoUsuario->salvar()) {
                echo "<p>Usuário cadastrado com sucesso!</p>";
                exit;
            } else {
                echo "<p>Erro ao cadastrar usuário.</p>";
            }
        } else {
            echo "<p>Método de requisição inválido.</p>";
        }
    }

    public function exibirDetalhesUsuario($id) {
        $usuario = Usuario::buscarPorId($id);
        if ($usuario) {
            echo "<h2>Detalhes do Usuário</h2>";
            echo "<p>ID: " . htmlspecialchars($usuario->getIdusuario()) . "</p>";
            echo "<p>Nome: " . htmlspecialchars($usuario->getNome()) . "</p>";
            echo "<p>CPF: " . htmlspecialchars($usuario->getCpf()) . "</p>";
            echo "<p>Email: " . htmlspecialchars($usuario->getEmail()) . "</p>";
        } else {
            echo "<p>Usuário não encontrado.</p>";
        }
    }

    public function exibirVisualizarCadastro($id) {
        $usuario = Usuario::buscarPorId($id);
        $outrasFormacoesDAO = new OutrasFormacoesDAO();
        $outrasFormacoes = $outrasFormacoesDAO->listarPorUsuario($id);
        include '../view/ADMVisualizarCadastro.php';
    }

    public function processarAdicionarOutraFormacao() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idusuario = filter_input(INPUT_POST, 'idusuario', FILTER_SANITIZE_NUMBER_INT);
            $inicio = filter_input(INPUT_POST, 'inicio', FILTER_SANITIZE_STRING);
            $fim = filter_input(INPUT_POST, 'fim', FILTER_SANITIZE_STRING);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);

            if ($idusuario && $inicio && $descricao) {
                $novaFormacao = new OutrasFormacoes(null, $idusuario, $inicio, $fim, $descricao);
                $dao = new OutrasFormacoesDAO();
                if ($dao->inserir($novaFormacao)) {
                    echo "sucesso"; // Indica sucesso para o AJAX
                } else {
                    echo "erro_inserir";
                }
            } else {
                echo "dados_invalidos";
            }
        } else {
            echo "metodo_invalido";
        }
    }

    public function processarApagarOutraFormacao() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idoutrasformacoes = filter_input(INPUT_POST, 'idoutrasformacoes', FILTER_SANITIZE_NUMBER_INT);

            if ($idoutrasformacoes) {
                $dao = new OutrasFormacoesDAO();
                if ($dao->excluir($idoutrasformacoes)) {
                    echo "sucesso"; // Indica sucesso para o AJAX
                } else {
                    echo "erro_excluir";
                }
            } else {
                echo "id_invalido";
            }
        } else {
            echo "metodo_invalido";
        }
    }
}

?>