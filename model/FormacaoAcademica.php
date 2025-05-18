<?php

class FormacaoAcademica {
    private $idformacaoacademica;
    private $idusuario;
    private $inicio;
    private $fim;
    private $descricao;

    /**
     * Construtor da classe FormacaoAcademica.
     * @param int|null $idformacaoacademica
     * @param int|null $idusuario
     * @param string|null $inicio (formato 'YYYY-MM-DD')
     * @param string|null $fim (formato 'YYYY-MM-DD')
     * @param string|null $descricao
     */
    public function __construct($idformacaoacademica = null, $idusuario = null, $inicio = null, $fim = null, $descricao = null) {
        $this->idformacaoacademica = $idformacaoacademica;
        $this->idusuario = $idusuario;
        $this->inicio = $inicio;
        $this->fim = $fim;
        $this->descricao = $descricao;
    }

    // Métodos Getters
    public function getIdformacaoacademica() {
        return $this->idformacaoacademica;
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
    public function setIdformacaoacademica($idformacaoacademica) {
        $this->idformacaoacademica = $idformacaoacademica;
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
        require_once '../dao/FormacaoAcademicaDAO.php';
        $dao = new FormacaoAcademicaDAO();
        return $dao->inserir($this);
    }

    public function atualizar() {
        require_once '../dao/FormacaoAcademicaDAO.php';
        $dao = new FormacaoAcademicaDAO();
        return $dao->atualizar($this);
    }

    public static function excluir($id) {
        require_once '../dao/FormacaoAcademicaDAO.php';
        $dao = new FormacaoAcademicaDAO();
        return $dao->excluir($id);
    }

    public static function buscarPorId($id) {
        require_once '../dao/FormacaoAcademicaDAO.php';
        $dao = new FormacaoAcademicaDAO();
        return $dao->buscarPorId($id);
    }

    public static function listarPorUsuario($idusuario) {
        require_once '../dao/FormacaoAcademicaDAO.php';
        $dao = new FormacaoAcademicaDAO();
        return $dao->listarPorUsuario($idusuario);
    }
}

?>