<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teamName = $_POST['team_name'];
    $country = $_POST['country'];

    try {
        $stmt = $pdo->prepare("INSERT INTO teams (team_name, country) VALUES (?, ?)");
        $stmt->execute([$teamName, $country]);
        echo json_encode(['success' => true, 'message' => 'Team created successfully']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error creating the team: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
?>

