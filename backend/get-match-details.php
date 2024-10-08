<?php
require_once 'db_connection.php';

$match_id = $_GET['match_id'] ?? null;

if ($match_id) {
    try {
        // Retrieve match details
 
        $stmt = $pdo->prepare("SELECT * FROM matches WHERE id = ?");
        $stmt->execute([$match_id]);
        $match = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the match exists

        if ($match) {
            // Retrieve the odds for the teams in this match

            $stmt = $pdo->prepare("SELECT team, odds FROM team_odds WHERE match_id = ?");
            $stmt->execute([$match_id]);
            $odds = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Prepare the response with the match details and team odds

            $response = [
                'match' => $match,
                'odds' => $odds
            ];

            echo json_encode($response);
        } else {
            echo json_encode(['error' => 'Match non trouvé']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erreur lors du chargement des détails du match: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID de match manquant']);
}
?>

