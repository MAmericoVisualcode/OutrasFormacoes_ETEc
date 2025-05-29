<?php

// Defina as constantes para a conexão com o banco de dados MySQL
define('DB_HOST', 'localhost'); // Geralmente é 'localhost' para servidores locais
define('DB_NAME', 'projeto_final'); // O nome do meu banco de dados (eu mencionei 'projeto_final')
define('DB_USER', 'root'); // O nome de usuário padrão do MySQL no USBwebserver geralmente é 'root'
define('DB_PASS', ''); // A senha padrão do MySQL no USBwebserver geralmente é vazia ('')
define('DB_PORT', 3307); // A porta do meu servidor MySQL

try {
    // Cria uma nova instância da classe PDO para a conexão com o banco de dados
    $pdo = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);

    // Defina o modo de erro do PDO para exceções. Isso é importante para tratamento de erros.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Opcional: Defina o modo de fetch padrão para objetos. Isso pode ser útil mais tarde.
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

} catch (PDOException $e) {
    // Se ocorrer algum erro na conexão, este bloco catch será executado
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Agora a variável $pdo contém a sua conexão com o banco de dados
// Você poderá usar $pdo em outras partes do seu código para executar consultas.

?>