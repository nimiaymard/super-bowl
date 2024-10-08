<?php
require_once 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    // Récupérer les informations de l'utilisateur
    $stmt = $pdo->prepare("SELECT firstname, lastname, email FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer les paris de l'utilisateur avec les informations sur les matchs
    $stmt = $pdo->prepare("
        SELECT 
            bets.amount, 
            bets.team, 
            bets.created_at, 
            matches.team1, 
            matches.team2, 
            matches.date, 
            matches.time, 
            matches.status, 
            matches.score
        FROM 
            bets
        INNER JOIN 
            matches ON bets.match_id = matches.id
        WHERE 
            bets.user_id = ?
        ORDER BY 
            bets.created_at DESC
    ");
    $stmt->execute([$user_id]);
    $bets = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return data in JSON format

    header('Content-Type: application/json');
    echo json_encode(['user_info' => $user_info, 'bets' => $bets]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Error retrieving data: ' . $e->getMessage()]);
}
