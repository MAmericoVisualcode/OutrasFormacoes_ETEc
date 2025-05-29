<?php

// Incluir os arquivos necessários
require_once 'config/conexao.php';
require_once 'model/Administrador.php';
require_once 'dao/AdministradorDAO.php';

echo "<h2>Testando Conexão e AdministradorDAO</h2>";

try {
    // 1. Testar a conexão
    $conexao = Conexao::getConexao();
    echo "<p>Conexão com o banco de dados estabelecida com sucesso!</p>";

    // 2. Instanciar o DAO do Administrador
    $administradorDAO = new AdministradorDAO($conexao);
    echo "<p>AdministradorDAO instanciado.</p>";

    // 3. Criar um objeto Administrador para teste
    $adminTeste = new Administrador();
    $adminTeste->setNome("Admin Teste");
    $adminTeste->setCpf("12345678900");
    $adminTeste->setSenha("senha123"); // Lembre-se: idealmente, use password_hash()

    echo "<p>Tentando cadastrar um administrador de teste...</p>";

    // 4. Inserir o administrador no banco de dados
    if ($administradorDAO->inserir($adminTeste)) {
        echo "<p>Administrador '{$adminTeste->getNome()}' cadastrado com sucesso!</p>";

        // Opcional: Tentar buscar o administrador para verificar a inserção
        $adminEncontrado = $administradorDAO->buscarPorCpf("12345678900");
        if ($adminEncontrado) {
            echo "<p>Administrador encontrado após a inserção: ID " . $adminEncontrado->getIdadministrador() . ", Nome: " . $adminEncontrado->getNome() . "</p>";
        } else {
            echo "<p>Erro: Administrador não encontrado após a inserção.</p>";
        }

    } else {
        echo "<p>Erro ao cadastrar o administrador de teste.</p>";
    }

} catch (Exception $e) {
    echo "<p style='color: red;'>Erro: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p>Verifique o banco de dados para confirmar a inserção.</p>";

?>