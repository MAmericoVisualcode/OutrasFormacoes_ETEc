<?php

class ExperienciaProfissional {
    private $idexperienciaprofissional;
    private $idusuario;
    private $inicio;
    private $fim;
    private $empresa;
    private $descricao;

    /**
     * Construtor da classe ExperienciaProfissional.
     * @param int|null $idexperienciaprofissional
     * @param int|null $idusuario
     * @param string|null $inicio (formato 'YYYY-MM-DD')
     * @param string|null $fim (formato 'YYYY-MM-DD')
     * @param string|null $empresa
     * @param string|null $descricao
     */
    public function __construct($idexperienciaprofissional = null, $idusuario = null, $inicio = null, $fim = null, $empresa = null, $descricao = null) {
        $this->idexperienciaprofissional = $idexperienciaprofissional;
        $this->idusuario = $idusuario;
        $this->inicio = $inicio;
        $this->fim = $fim;
        $this->empresa = $empresa;
        $this->descricao = $descricao;
    }

    // Métodos Getters
    public function getIdexperienciaprofissional() {
        return $this->idexperienciaprofissional;
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

    public function getEmpresa() {
        return $this->empresa;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    // Métodos Setters
    public function setIdexperienciaprofissional($idexperienciaprofissional) {
        $this->idexperienciaprofissional = $idexperienciaprofissional;
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

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    // Métodos para interação com o Banco de Dados usando o DAO
    public function salvar() {
        require_once '../dao/ExperienciaProfissionalDAO.php';
        $dao = new ExperienciaProfissionalDAO();
        return $dao->inserir($this);
    }

    public function atualizar() {
        require_once '../dao/ExperienciaProfissionalDAO.php';
        $dao = new ExperienciaProfissionalDAO();
        return $dao->atualizar($this);
    }

    public static function excluir($id) {
        require_once '../dao/ExperienciaProfissionalDAO.php';
        $dao = new ExperienciaProfissionalDAO();
        return $dao->excluir($id);
    }

    public static function buscarPorId($id) {
        require_once '../dao/ExperienciaProfissionalDAO.php';
        $dao = new ExperienciaProfissionalDAO();
        return $dao->buscarPorId($id);
    }

    public static function listarPorUsuario($idusuario) {
        require_once '../dao/ExperienciaProfissionalDAO.php';
        $dao = new ExperienciaProfissionalDAO();
        return $dao->listarPorUsuario($idusuario);
    }
}

?>