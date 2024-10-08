<?php
require_once 'db_connection.php';

// Retrieve today's matches

$query = $pdo->prepare("SELECT team1, team2, time, status FROM matches WHERE DATE(time) = CURDATE()");
$query->execute();
$matches = $query->fetchAll(PDO::FETCH_ASSOC);

// Send data in JSON format

header('Content-Type: application/json');
echo json_encode(['matches' => $matches]);
?>
