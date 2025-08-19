<?php

function getConnection() {
    $host = 'localhost';         
    $dbname = 'ouvidoria'; 
    $user = 'postgres';       
    $password = '1a2badmin#$#';     // Senha do PostgreSQL
    $port = '5432';              // Porta padrão

    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }
}