<?php

class OutrasFormacoes {
    private $idoutrasformacoes;
    private $idusuario;
    private $inicio;
    private $fim;
    private $descricao;

    public function __construct($idoutrasformacoes = null, $idusuario = null, $inicio = null, $fim = null, $descricao = null) {
        $this->idoutrasformacoes = $idoutrasformacoes;
        $this->idusuario = $idusuario;
        $this->inicio = $inicio;
        $this->fim = $fim;
        $this->descricao = $descricao;
    }

    // Métodos Getters
    public function getIdoutrasformacoes() {
        return $this->idoutrasformacoes;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function getInicio() {
        return $this->inicio;
    }

    public function getFim() {
        return $this->fim;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    // Métodos Setters
    public function setIdoutrasformacoes($idoutrasformacoes) {
        $this->idoutrasformacoes = $idoutrasformacoes;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    public function setFim($fim) {
        $this->fim = $fim;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    // Métodos para interação com o Banco de Dados usando o DAO
    public function salvar() {
        require_once '../dao/OutrasFormacoesDAO.php';
        $dao = new OutrasFormacoesDAO();
        return $dao->inserir($this);
    }

    public function atualizar() {
        require_once '../dao/OutrasFormacoesDAO.php';
        $dao = new OutrasFormacoesDAO();
        return $dao->atualizar($this);
    }

    public static function excluir($id) {
        require_once '../dao/OutrasFormacoesDAO.php';
        $dao = new OutrasFormacoesDAO();
        return $dao->excluir($id);
    }

    public static function buscarPorId($id) {
        require_once '../dao/OutrasFormacoesDAO.php';
        $dao = new OutrasFormacoesDAO();
        return $dao->buscarPorId($id);
    }

    public static function listarPorUsuario($idusuario) {
        require_once '../dao/OutrasFormacoesDAO.php';
        $dao = new OutrasFormacoesDAO();
        return $dao->listarPorUsuario($idusuario);
    }
}

?>