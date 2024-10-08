<?php
require_once 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not authenticated']);
    exit;
}

$user_id = $_SESSION['user_id'];
$match_id = $_POST['match_id'];
$amount = $_POST['amount'];
$team = $_POST['team'];

$stmt = $pdo->prepare("INSERT INTO bets (user_id, match_id, amount, team) VALUES (?, ?, ?, ?)");
if ($stmt->execute([$user_id, $match_id, $amount, $team])) {
    echo json_encode(['success' => 'Bet placed successfully']);
} else {
    echo json_encode(['error' => 'Error placing bet']);
}
