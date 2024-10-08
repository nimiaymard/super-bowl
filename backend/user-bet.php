<?php
session_start();
header('Content-Type: application/json');
require_once 'db_connection.php';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare("SELECT b.id, m.team1, m.team2, b.amount, b.team, b.created_at
                               FROM bets b
                               JOIN matches m ON b.match_id = m.id
                               WHERE b.user_id = ?");
        $stmt->execute([$user_id]);
        $bets = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['bets' => $bets]);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error retrieving bets: '
 . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'User not authenticated']);
}
?>
