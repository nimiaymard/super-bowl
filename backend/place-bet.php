<?php
require_once 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $match_id = $_POST['match_id'] ?? null;
    $team = $_POST['team'] ?? null;
    $amount = $_POST['amount'] ?? null;

    if ($match_id && $team && $amount) {
        try {
            $stmt = $pdo->prepare("INSERT INTO bets (user_id, match_id, team, amount) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $match_id, $team, $amount]);
            echo json_encode(['success' =>'Bet placed successfully']);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Error placing the bet: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Please provide all required fields'
]);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>



