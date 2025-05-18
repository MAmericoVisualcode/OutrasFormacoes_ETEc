<?php

require_once '../config/config.php';
require_once '../model/OutrasFormacoes.php';

class OutrasFormacoesDAO {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function inserir(OutrasFormacoes $formacao) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO outrasformacoes (idusuario, inicio, fim, descricao) VALUES (:idusuario, :inicio, :fim, :descricao)");
            $stmt->bindValue(':idusuario', $formacao->getIdusuario());
            $stmt->bindValue(':inicio', $formacao->getInicio());
            $stmt->bindValue(':fim', $formacao->getFim());
            $stmt->bindValue(':descricao', $formacao->getDescricao());
            return $stmt->execute();
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
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'OutrasFormacoes');
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erro ao buscar outra formação por ID no banco de dados: " . $e->getMessage();
            return null;
        }
    }

    public function listarPorUsuario(int $idusuario): array {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM outrasformacoes WHERE idusuario = :idusuario");
            $stmt->bindValue(':idusuario', $idusuario);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'OutrasFormacoes');
        } catch (PDOException $e) {
            echo "Erro ao listar outras formações por usuário no banco de dados: " . $e->getMessage();
            return [];
        }
    }
}

?>