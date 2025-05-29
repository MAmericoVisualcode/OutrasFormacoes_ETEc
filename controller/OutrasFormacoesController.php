<?php
if(!isset($_SESSION))
{
    session_start();
}
// Inclui a classe Model e DAO
require_once __DIR__ . '/../model/OutrasFormacoes.php';
require_once __DIR__ . '/../dao/OutrasFormacoesDAO.php';

class OutrasFormacoesController {

    private $outrasFormacoesDAO;

    public function __construct() {
        $this->outrasFormacoesDAO = new OutrasFormacoesDAO();
    }

    public function inserir($idusuario, $inicio, $fim, $descricao) {
        $formacao = new OutrasFormacoes(null, $idusuario, $inicio, $fim, $descricao);
        return $this->outrasFormacoesDAO->inserir($formacao);
    }

    public function atualizar($idoutrasformacoes, $idusuario, $inicio, $fim, $descricao) {
        $formacao = new OutrasFormacoes($idoutrasformacoes, $idusuario, $inicio, $fim, $descricao);
        return $this->outrasFormacoesDAO->atualizar($formacao);
    }

    public function remover($idoutrasformacoes) {
        return $this->outrasFormacoesDAO->excluir($idoutrasformacoes);
    }

    public function buscarPorId($idoutrasformacoes) {
        return $this->outrasFormacoesDAO->buscarPorId($idoutrasformacoes);
    }

    public function listarPorUsuario($idusuario) {
        return $this->outrasFormacoesDAO->listarPorUsuario($idusuario);
    }
}
?>