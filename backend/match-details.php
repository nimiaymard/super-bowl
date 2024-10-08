<?php
header('Content-Type: application/json');
require_once 'db_connection.php';

if (isset($_GET['match_id'])) {
    $match_id = intval($_GET['match_id']);
    try {
        if (!$pdo) {
            echo json_encode(['error' => 'Échec de la connexion à la base de données']);
            exit;
        }
        // Match details
        $stmt = $pdo->prepare("SELECT team1, team2, date, time, status, weather FROM matches WHERE id = ?");
        $stmt->execute([$match_id]);
        $match = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$match) {
            echo json_encode(['error' => 'Match non trouvé']);
            exit;
        }

        // Players
        $stmt = $pdo->prepare("SELECT first_name, last_name, team FROM players WHERE match_id = ?");
        $stmt->execute([$match_id]);
        $players = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Team odds

        $stmt = $pdo->prepare("SELECT team, odds FROM team_odds WHERE match_id = ?");
        $stmt->execute([$match_id]);
        $odds = $stmt->fetchAll(PDO::FETCH_ASSOC);

       // Comments

        $stmt = $pdo->prepare("SELECT commentator, comment, score FROM comments WHERE match_id = ?");
        $stmt->execute([$match_id]);
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Send the results

        echo json_encode([
            'match' => $match,
            'players' => $players,
            'odds' => $odds,
            'comments' => $comments
        ]);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Query failed SQL: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'No match ID provided']);
}
?>



        

