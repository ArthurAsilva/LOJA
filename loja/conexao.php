<?php
$host = 'localhost';
$dbname = 'loja';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Tenta criar o banco de dados se não existir
    if ($e->getCode() == 1049) {
        try {
            $pdo = new PDO("mysql:host=$host", $user, $pass);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
            $pdo->exec("USE $dbname");
            
            // Cria a tabela produtos
            $pdo->exec("CREATE TABLE IF NOT EXISTS produtos (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                preco DECIMAL(10,2) NOT NULL,
                quantidade INT(11) NOT NULL
            )");
            
            echo "<div class='alert alert-info'>Banco de dados criado com sucesso!</div>";
        } catch (PDOException $e2) {
            die("<div class='alert alert-danger'>Erro ao criar banco de dados: " . $e2->getMessage() . "</div>");
        }
    } else {
        die("<div class='alert alert-danger'>Erro de conexão: " . $e->getMessage() . "</div>");
    }
}
?>