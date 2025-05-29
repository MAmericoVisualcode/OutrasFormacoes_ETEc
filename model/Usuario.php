<?php

class Usuario {
    private $idusuario;
    private $nome;
    private $cpf;
    private $datanascimento;
    private $email;
    private $senha;

    public function __construct($idusuario = null, $nome = null, $cpf = null, $datanascimento = null, $email = null, $senha = null) {
        $this->idusuario = $idusuario;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->datanascimento = $datanascimento;
        $this->email = $email;
        $this->senha = $senha;
    }

    // Métodos Getters
    public function getIdusuario() {
        return $this->idusuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getDatanascimento() {
        return $this->datanascimento;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    // Métodos Setters
    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setDatanascimento($datanascimento) {
        $this->datanascimento = $datanascimento;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    // A Model agora não terá mais a lógica de acesso ao banco de dados diretamente.
    // Essa lógica estará no UsuarioDAO.
    // Podemos adicionar métodos aqui que utilizam o UsuarioDAO para realizar as operações.

    // Exemplo de método para inserir um usuário usando o DAO:
    public function salvar() {
        require_once '../dao/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->inserir($this);
    }

    // Exemplo de método para atualizar um usuário usando o DAO:
    public function atualizar() {
        require_once '../dao/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->atualizar($this);
    }

    // Exemplo de método estático para excluir um usuário por ID usando o DAO:
    public static function excluir($id) {
        require_once '../dao/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->excluir($id);
    }

    // Exemplo de método estático para buscar um usuário por ID usando o DAO:
    public static function buscarPorId($id) {
        require_once '../dao/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->buscarPorId($id);
    }

    // Exemplo de método estático para buscar um usuário por email usando o DAO:
    public static function buscarPorEmail($email) {
        require_once '../dao/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->buscarPorEmail($email);
    }

    // Exemplo de método estático para listar todos os usuários usando o DAO:
    public static function listarTodos() {
        require_once '../dao/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->listarTodos();
    }
}

?>