<?php

require_once '../config/config.php';
require_once '../model/Usuario.php'; // Importamos a classe Usuario para trabalhar com objetos Usuario

class UsuarioDAO {

    private $pdo;

    public function __construct() {
        global $pdo; // Usamos a conexão PDO já estabelecida no config.php
        $this->pdo = $pdo;
    }

    public function inserir(Usuario $usuario) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO usuario (nome, cpf, datanascimento, email, senha) VALUES (:nome, :cpf, :datanascimento, :email, :senha)");
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':cpf', $usuario->getCpf());
            $stmt->bindValue(':datanascimento', $usuario->getDatanascimento());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':senha', $usuario->getSenha()); // Em produção, lembre-se de usar password_hash()!
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir usuário no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function atualizar(Usuario $usuario) {
        try {
            $stmt = $this->pdo->prepare("UPDATE usuario SET nome = :nome, cpf = :cpf, datanascimento = :datanascimento, email = :email, senha = :senha WHERE idusuario = :idusuario");
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':cpf', $usuario->getCpf());
            $stmt->bindValue(':datanascimento', $usuario->getDatanascimento());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':senha', $usuario->getSenha()); // Em produção, lembre-se de usar password_hash()!
            $stmt->bindValue(':idusuario', $usuario->getIdusuario());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar usuário no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function excluir(int $id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM usuario WHERE idusuario = :id");
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir usuário do banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function buscarPorId(int $id): ?Usuario {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE idusuario = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erro ao buscar usuário por ID no banco de dados: " . $e->getMessage();
            return null;
        }
    }

    public function buscarPorEmail(string $email): ?Usuario {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email");
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erro ao buscar usuário por email no banco de dados: " . $e->getMessage();
            return null;
        }
    }

    public function listarTodos(): array {
        try {
            $stmt = $this->pdo->query("SELECT * FROM usuario");
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Usuario');
        } catch (PDOException $e) {
            echo "Erro ao listar todos os usuários do banco de dados: " . $e->getMessage();
            return [];
        }
    }
}

?>