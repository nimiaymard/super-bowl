<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teamId = $_POST['team_id'];
    $playerName = $_POST['player_name'];
    $playerNumber = $_POST['player_number'];

    try {
        $stmt = $pdo->prepare("INSERT INTO players (team_id, player_name, player_number) VALUES (?, ?, ?)");
        $stmt->execute([$teamId, $playerName, $playerNumber]);
        echo json_encode(['success' => true, 'message' => 'Joueur créé avec succès']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la création du joueur: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}
?>
