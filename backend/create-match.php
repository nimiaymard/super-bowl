<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $team1Id = $_POST['team1_id'];
    $team2Id = $_POST['team2_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $oddsTeam1 = $_POST['odds_team1'];
    $oddsTeam2 = $_POST['odds_team2'];

    try {
        // Insert match
        $stmt = $pdo->prepare("INSERT INTO matches (team1, team2, date, time) VALUES (?, ?, ?, ?)");
        $stmt->execute([$team1Id, $team2Id, $date, $time]);
        $matchId = $pdo->lastInsertId();

        // Insert odds
        $stmt = $pdo->prepare("INSERT INTO team_odds (match_id, team, odds) VALUES (?, ?, ?), (?, ?, ?)");
        $stmt->execute([$matchId, $team1Id, $oddsTeam1, $matchId, $team2Id, $oddsTeam2]);

        echo json_encode(['success' => true, 'message' => 'Match planifié avec succès']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la planification du match: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}
?>
