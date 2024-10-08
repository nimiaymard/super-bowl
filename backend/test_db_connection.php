<?php
require_once 'db_connection.php';

try {
    $pdo->query("SELECT 1");  
    echo 'Connexion réussie à la base de données.';
} catch (\PDOException $e) {
    echo 'Échec de la connexion : ' . $e->getMessage();
}
