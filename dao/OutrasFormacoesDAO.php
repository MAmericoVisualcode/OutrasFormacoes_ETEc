<?php

// Alterado para usar o seu arquivo de conexão principal
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../model/OutrasFormacoes.php';

class OutrasFormacoesDAO {

    private $pdo;

    public function __construct() {
        // Alterado para usar o método estático de Conexao
        $this->pdo = Conexao::conectar();
    }

    public function inserir(OutrasFormacoes $formacao) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO outrasformacoes (idusuario, inicio, fim, descricao) VALUES (:idusuario, :inicio, :fim, :descricao)");
            $stmt->bindValue(':idusuario', $formacao->getIdusuario());
            $stmt->bindValue(':inicio', $formacao->getInicio());
            $stmt->bindValue(':fim', $formacao->getFim());
            $stmt->bindValue(':descricao', $formacao->getDescricao());

            if ($stmt->execute()) {
                $formacao->setIdoutrasformacoes($this->pdo->lastInsertId()); // Atualiza o ID no objeto
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Erro ao inserir outra formação no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function atualizar(OutrasFormacoes $formacao) {
        try {
            $stmt = $this->pdo->prepare("UPDATE outrasformacoes SET idusuario = :idusuario, inicio = :inicio, fim = :fim, descricao = :descricao WHERE idoutrasformacoes = :idoutrasformacoes");
            $stmt->bindValue(':idusuario', $formacao->getIdusuario());
            $stmt->bindValue(':inicio', $formacao->getInicio());
            $stmt->bindValue(':fim', $formacao->getFim());
            $stmt->bindValue(':descricao', $formacao->getDescricao());
            $stmt->bindValue(':idoutrasformacoes', $formacao->getIdoutrasformacoes());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar outra formação no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function excluir(int $id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM outrasformacoes WHERE idoutrasformacoes = :id");
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir outra formação do banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function buscarPorId(int $id): ?OutrasFormacoes {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM outrasformacoes WHERE idoutrasformacoes = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                // Instancia manualmente para usar o construtor do Model
                return new OutrasFormacoes(
                    $data['idoutrasformacoes'],
                    $data['idusuario'],
                    $data['inicio'],
                    $data['fim'],
                    $data['descricao']
                );
            }
            return null;
        } catch (PDOException $e) {
            echo "Erro ao buscar outra formação por ID no banco de dados: " . $e->getMessage();
            return null;
        }
    }

    public function listarPorUsuario(int $idusuario): array {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM outrasformacoes WHERE idusuario = :idusuario ORDER BY inicio DESC");
            $stmt->bindValue(':idusuario', $idusuario);
            $stmt->execute();
            $formacoes = [];
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $formacoes[] = new OutrasFormacoes(
                    $data['idoutrasformacoes'],
                    $data['idusuario'],
                    $data['inicio'],
                    $data['fim'],
                    $data['descricao']
                );
            }
            return $formacoes;
        } catch (PDOException $e) {
            echo "Erro ao listar outras formações por usuário no banco de dados: " . $e->getMessage();
            return [];
        }
    }
}

?>