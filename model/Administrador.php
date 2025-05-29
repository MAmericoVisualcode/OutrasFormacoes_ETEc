<?php

class Administrador {
    private $idadministrador;
    private $nome;
    private $cpf;
    private $senha;

    /**
     * Construtor da classe Administrador.
     * @param int|null $idadministrador
     * @param string|null $nome
     * @param string|null $cpf
     * @param string|null $senha
     */
    public function __construct($idadministrador = null, $nome = null, $cpf = null, $senha = null) {
        $this->idadministrador = $idadministrador;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->senha = $senha;
    }

    // Métodos Getters
    public function getIdadministrador() {
        return $this->idadministrador;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getSenha() {
        return $this->senha;
    }

    // Métodos Setters
    public function setIdadministrador($idadministrador) {
        $this->idadministrador = $idadministrador;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    // Métodos para interação com o Banco de Dados usando o DAO
    // Vamos adicionar esses métodos aqui para seguir o seu padrão de delegação para o DAO.

    public function salvar() {
        require_once '../dao/AdministradorDAO.php'; // Caminho relativo ao model
        $dao = new AdministradorDAO();
        return $dao->inserir($this);
    }

    public function atualizar() {
        require_once '../dao/AdministradorDAO.php'; // Caminho relativo ao model
        $dao = new AdministradorDAO();
        return $dao->atualizar($this);
    }

    public static function excluir($id) {
        require_once '../dao/AdministradorDAO.php'; // Caminho relativo ao model
        $dao = new AdministradorDAO();
        return $dao->excluir($id);
    }

    public static function buscarPorId($id) {
        require_once '../dao/AdministradorDAO.php'; // Caminho relativo ao model
        $dao = new AdministradorDAO();
        return $dao->buscarPorId($id);
    }
    
    public static function buscarPorCpf($cpf) {
        require_once '../dao/AdministradorDAO.php'; // Caminho relativo ao model
        $dao = new AdministradorDAO();
        return $dao->buscarPorCpf($cpf);
    }

    public static function listarTodos() {
        require_once '../dao/AdministradorDAO.php'; // Caminho relativo ao model
        $dao = new AdministradorDAO();
        return $dao->listarTodos();
    }
}

?>