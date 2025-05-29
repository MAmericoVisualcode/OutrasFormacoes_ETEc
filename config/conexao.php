<?php

class Conexao {
    private static $instance;
    private $host = 'localhost';
    private $dbname = 'projeto_final';
    private $user = 'root'; // Geralmente 'root' no USBWebserver
    private $password = ''; // Geralmente vazio no USBWebserver
    private $port = '3307'; // Porta MySQL configurada no USBWebserver

    private function __construct() {
        // Construtor privado para implementar Singleton
    }

    public static function getConexao() {
        if (!isset(self::$instance)) {
            try {
                // Usamos PDO para uma conexão mais segura e flexível
                $dsn = "mysql:host=" . self::$instance->host . ";port=" . self::$instance->port . ";dbname=" . self::$instance->dbname;
                self::$instance = new PDO($dsn, self::$instance->user, self::$instance->password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->exec("SET CHARACTER SET utf8");
            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}

?>