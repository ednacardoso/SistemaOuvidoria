<?php

function getConnection() {
    
        return $pdo;
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }

}
