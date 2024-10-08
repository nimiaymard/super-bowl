<?php
require_once 'db_connection.php';

$match_id = $_GET['match_id'];
$user_id = $_GET['user_id'];

$stmt = $pdo->prepare("SELECT team, amount FROM bets WHERE match_id = ? AND user_id = ?");
$stmt->execute([$match_id, $user_id]);
$bet = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
if ($bet) {
    echo json_encode(['exists' => true, 'team' => $bet['team'], 'amount' => $bet['amount']]);
} else {
    echo json_encode(['exists' => false]);
}
?>
