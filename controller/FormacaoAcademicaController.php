<?php
if(!isset($_SESSION))
{
    session_start();
}
// Inclui a classe Model e DAO
require_once __DIR__ . '/../model/FormacaoAcademica.php'; // Nome do Model atualizado
require_once __DIR__ . '/../dao/FormacaoAcademicaDAO.php';

class FormacaoAcademicaController { // Nome da classe atualizado

    private $formacaoAcademicaDAO;

    public function __construct() {
        $this->formacaoAcademicaDAO = new FormacaoAcademicaDAO();
    }

    public function inserir($idusuario, $inicio, $fim, $descricao) {
        $formacao = new FormacaoAcademica(null, $idusuario, $inicio, $fim, $descricao);
        return $this->formacaoAcademicaDAO->inserir($formacao);
    }

    public function atualizar($idformacaoacademica, $idusuario, $inicio, $fim, $descricao) {
        $formacao = new FormacaoAcademica($idformacaoacademica, $idusuario, $inicio, $fim, $descricao);
        return $this->formacaoAcademicaDAO->atualizar($formacao);
    }

    public function remover($idformacaoacademica) {
        return $this->formacaoAcademicaDAO->excluir($idformacaoacademica);
    }

    public function buscarPorId($idformacaoacademica) {
        return $this->formacaoAcademicaDAO->buscarPorId($idformacaoacademica);
    }

    public function listarPorUsuario($idusuario) {
        return $this->formacaoAcademicaDAO->listarPorUsuario($idusuario);
    }
}
?>
