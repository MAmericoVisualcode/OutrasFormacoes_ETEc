<?php

// Alterado para usar o seu arquivo de conexão principal
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../model/FormacaoAcademica.php';

class FormacaoAcademicaDAO {

    private $pdo;

    public function __construct() {
        // Alterado para usar o método estático de Conexao
        $this->pdo = Conexao::conectar();
    }

    public function inserir(FormacaoAcademica $formacao) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO formacaoacademica (idusuario, inicio, fim, descricao) VALUES (:idusuario, :inicio, :fim, :descricao)");
            $stmt->bindValue(':idusuario', $formacao->getIdusuario());
            $stmt->bindValue(':inicio', $formacao->getInicio());
            $stmt->bindValue(':fim', $formacao->getFim());
            $stmt->bindValue(':descricao', $formacao->getDescricao());

            if ($stmt->execute()) {
                $formacao->setIdformacaoacademica($this->pdo->lastInsertId()); // Atualiza o ID no objeto
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Erro ao inserir formação acadêmica no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function atualizar(FormacaoAcademica $formacao) {
        try {
            $stmt = $this->pdo->prepare("UPDATE formacaoacademica SET idusuario = :idusuario, inicio = :inicio, fim = :fim, descricao = :descricao WHERE idformacaoacademica = :idformacaoacademica");
            $stmt->bindValue(':idusuario', $formacao->getIdusuario());
            $stmt->bindValue(':inicio', $formacao->getInicio());
            $stmt->bindValue(':fim', $formacao->getFim());
            $stmt->bindValue(':descricao', $formacao->getDescricao());
            $stmt->bindValue(':idformacaoacademica', $formacao->getIdformacaoacademica());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar formação acadêmica no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function excluir(int $id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM formacaoacademica WHERE idformacaoacademica = :id");
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir formação acadêmica do banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function buscarPorId(int $id): ?FormacaoAcademica {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM formacaoacademica WHERE idformacaoacademica = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                // Instancia manualmente para usar o construtor do Model
                return new FormacaoAcademica(
                    $data['idformacaoacademica'],
                    $data['idusuario'],
                    $data['inicio'],
                    $data['fim'],
                    $data['descricao']
                );
            }
            return null;
        } catch (PDOException $e) {
            echo "Erro ao buscar formação acadêmica por ID no banco de dados: " . $e->getMessage();
            return null;
        }
    }

    public function listarPorUsuario(int $idusuario): array {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM formacaoacademica WHERE idusuario = :idusuario ORDER BY inicio DESC");
            $stmt->bindValue(':idusuario', $idusuario);
            $stmt->execute();
            $formacoes = [];
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $formacoes[] = new FormacaoAcademica(
                    $data['idformacaoacademica'],
                    $data['idusuario'],
                    $data['inicio'],
                    $data['fim'],
                    $data['descricao']
                );
            }
            return $formacoes;
        } catch (PDOException $e) {
            echo "Erro ao listar formações acadêmicas por usuário no banco de dados: " . $e->getMessage();
            return [];
        }
    }
}

?>