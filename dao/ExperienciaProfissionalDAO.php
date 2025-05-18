<?php

require_once '../config/config.php';
require_once '../model/ExperienciaProfissional.php';

class ExperienciaProfissionalDAO {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function inserir(ExperienciaProfissional $experiencia) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO experienciaprofissional (idusuario, inicio, fim, empresa, descricao) VALUES (:idusuario, :inicio, :fim, :empresa, :descricao)");
            $stmt->bindValue(':idusuario', $experiencia->getIdusuario());
            $stmt->bindValue(':inicio', $experiencia->getInicio());
            $stmt->bindValue(':fim', $experiencia->getFim());
            $stmt->bindValue(':empresa', $experiencia->getEmpresa());
            $stmt->bindValue(':descricao', $experiencia->getDescricao());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir experiência profissional no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function atualizar(ExperienciaProfissional $experiencia) {
        try {
            $stmt = $this->pdo->prepare("UPDATE experienciaprofissional SET idusuario = :idusuario, inicio = :inicio, fim = :fim, empresa = :empresa, descricao = :descricao WHERE idexperienciaprofissional = :idexperienciaprofissional");
            $stmt->bindValue(':idusuario', $experiencia->getIdusuario());
            $stmt->bindValue(':inicio', $experiencia->getInicio());
            $stmt->bindValue(':fim', $experiencia->getFim());
            $stmt->bindValue(':empresa', $experiencia->getEmpresa());
            $stmt->bindValue(':descricao', $experiencia->getDescricao());
            $stmt->bindValue(':idexperienciaprofissional', $experiencia->getIdexperienciaprofissional());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar experiência profissional no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function excluir(int $id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM experienciaprofissional WHERE idexperienciaprofissional = :id");
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir experiência profissional do banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function buscarPorId(int $id): ?ExperienciaProfissional {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM experienciaprofissional WHERE idexperienciaprofissional = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'ExperienciaProfissional');
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erro ao buscar experiência profissional por ID no banco de dados: " . $e->getMessage();
            return null;
        }
    }

    public function listarPorUsuario(int $idusuario): array {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM experienciaprofissional WHERE idusuario = :idusuario");
            $stmt->bindValue(':idusuario', $idusuario);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'ExperienciaProfissional');
        } catch (PDOException $e) {
            echo "Erro ao listar experiências profissionais por usuário no banco de dados: " . $e->getMessage();
            return [];
        }
    }
}

?>