<?php

// Alterado para usar o seu arquivo de conexão principal
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../model/ExperienciaProfissional.php';

class ExperienciaProfissionalDAO {

    private $pdo;

    public function __construct() {
        // Alterado para usar o método estático de Conexao
        $this->pdo = Conexao::conectar();
    }

    public function inserir(ExperienciaProfissional $experiencia) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO experienciaprofissional (idusuario, inicio, fim, empresa, descricao) VALUES (:idusuario, :inicio, :fim, :empresa, :descricao)");
            $stmt->bindValue(':idusuario', $experiencia->getIdusuario());
            $stmt->bindValue(':inicio', $experiencia->getInicio());
            $stmt->bindValue(':fim', $experiencia->getFim());
            $stmt->bindValue(':empresa', $experiencia->getEmpresa());
            $stmt->bindValue(':descricao', $experiencia->getDescricao());

            if ($stmt->execute()) {
                $experiencia->setIdexperienciaprofissional($this->pdo->lastInsertId()); // Atualiza o ID no objeto
                return true;
            }
            return false;
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
            // Usar PDO::FETCH_CLASS diretamente com o construtor pode ser complicado se os nomes das colunas não baterem
            // Vamos buscar como array e instanciar manualmente para maior controle
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                return new ExperienciaProfissional(
                    $data['idexperienciaprofissional'],
                    $data['idusuario'],
                    $data['inicio'],
                    $data['fim'],
                    $data['empresa'],
                    $data['descricao']
                );
            }
            return null;
        } catch (PDOException $e) {
            echo "Erro ao buscar experiência profissional por ID no banco de dados: " . $e->getMessage();
            return null;
        }
    }

    public function listarPorUsuario(int $idusuario): array {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM experienciaprofissional WHERE idusuario = :idusuario ORDER BY inicio DESC");
            $stmt->bindValue(':idusuario', $idusuario);
            $stmt->execute();
            $experiencias = [];
            // Usar PDO::FETCH_CLASS diretamente com o construtor pode ser complicado se os nomes das colunas não baterem
            // Vamos buscar como array e instanciar manualmente para maior controle
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $experiencias[] = new ExperienciaProfissional(
                    $data['idexperienciaprofissional'],
                    $data['idusuario'],
                    $data['inicio'],
                    $data['fim'],
                    $data['empresa'],
                    $data['descricao']
                );
            }
            return $experiencias;
        } catch (PDOException $e) {
            echo "Erro ao listar experiências profissionais por usuário no banco de dados: " . $e->getMessage();
            return [];
        }
    }
}

?>