<?php

require_once '../config/config.php'; // Inclui o arquivo de configuração do banco de dados
require_once '../model/Administrador.php'; // Inclui a classe Model Administrador

class AdministradorDAO {

    private $pdo; // Variável para armazenar a conexão PDO

    public function __construct() {
        global $pdo; // Acessa a variável global $pdo definida em config.php
        $this->pdo = $pdo;
    }

    /**
     * Insere um novo administrador no banco de dados.
     * @param Administrador $administrador O objeto Administrador a ser inserido.
     * @return bool True se a inserção for bem-sucedida, false caso contrário.
     */
    public function inserir(Administrador $administrador): bool {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO administrador (nome, cpf, senha) VALUES (:nome, :cpf, :senha)");
            $stmt->bindValue(':nome', $administrador->getNome());
            $stmt->bindValue(':cpf', $administrador->getCpf());
            $stmt->bindValue(':senha', $administrador->getSenha()); // Lembre-se de hashear a senha antes de salvar em um ambiente de produção!
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir administrador no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Atualiza um administrador existente no banco de dados.
     * @param Administrador $administrador O objeto Administrador com os dados atualizados.
     * @return bool True se a atualização for bem-sucedida, false caso contrário.
     */
    public function atualizar(Administrador $administrador): bool {
        try {
            $stmt = $this->pdo->prepare("UPDATE administrador SET nome = :nome, cpf = :cpf, senha = :senha WHERE idadministrador = :idadministrador");
            $stmt->bindValue(':nome', $administrador->getNome());
            $stmt->bindValue(':cpf', $administrador->getCpf());
            $stmt->bindValue(':senha', $administrador->getSenha()); // Lembre-se de hashear a senha!
            $stmt->bindValue(':idadministrador', $administrador->getIdadministrador());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar administrador no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Exclui um administrador do banco de dados pelo ID.
     * @param int $id O ID do administrador a ser excluído.
     * @return bool True se a exclusão for bem-sucedida, false caso contrário.
     */
    public function excluir(int $id): bool {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM administrador WHERE idadministrador = :id");
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir administrador do banco de dados: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Busca um administrador no banco de dados pelo ID.
     * @param int $id O ID do administrador a ser buscado.
     * @return Administrador|null O objeto Administrador se encontrado, null caso contrário.
     */
    public function buscarPorId(int $id): ?Administrador {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM administrador WHERE idadministrador = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            // Define o modo de fetch para retornar um objeto da classe Administrador
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Administrador');
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erro ao buscar administrador por ID no banco de dados: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Busca um administrador no banco de dados pelo CPF.
     * @param string $cpf O CPF do administrador a ser buscado.
     * @return Administrador|null O objeto Administrador se encontrado, null caso contrário.
     */
    public function buscarPorCpf(string $cpf): ?Administrador {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM administrador WHERE cpf = :cpf");
            $stmt->bindValue(':cpf', $cpf);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Administrador');
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erro ao buscar administrador por CPF no banco de dados: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Lista todos os administradores cadastrados no banco de dados.
     * @return array Um array de objetos Administrador.
     */
    public function listarTodos(): array {
        try {
            $stmt = $this->pdo->query("SELECT * FROM administrador");
            // Define o modo de fetch para