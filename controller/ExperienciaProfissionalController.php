<?php
if(!isset($_SESSION))
{
    session_start();
}
// Inclui a classe Model e DAO
require_once __DIR__ . '/../model/ExperienciaProfissional.php';
require_once __DIR__ . '/../dao/ExperienciaProfissionalDAO.php';

class ExperienciaProfissionalController {

    private $experienciaProfissionalDAO;

    public function __construct() {
        $this->experienciaProfissionalDAO = new ExperienciaProfissionalDAO();
    }

    public function inserir($idusuario, $inicio, $fim, $empresa, $descricao) {
        $expP = new ExperienciaProfissional(null, $idusuario, $inicio, $fim, $empresa, $descricao);
        return $this->experienciaProfissionalDAO->inserir($expP);
    }

    public function atualizar($idexperienciaprofissional, $idusuario, $inicio, $fim, $empresa, $descricao) {
        $expP = new ExperienciaProfissional($idexperienciaprofissional, $idusuario, $inicio, $fim, $empresa, $descricao);
        return $this->experienciaProfissionalDAO->atualizar($expP);
    }

    public function remover($idexperienciaprofissional) {
        return $this->experienciaProfissionalDAO->excluir($idexperienciaprofissional);
    }

    public function buscarPorId($idexperienciaprofissional) {
        return $this->experienciaProfissionalDAO->buscarPorId($idexperienciaprofissional);
    }

    public function listarPorUsuario($idusuario) {
        return $this->experienciaProfissionalDAO->listarPorUsuario($idusuario);
    }
}
?>