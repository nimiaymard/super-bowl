<?php
require_once 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin'])) {
    header('Location: ../login.html');
    exit;
}

// Code to manage teams and matches

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'create_team') {
        $team_name = $_POST['team_name'];
        $country = $_POST['country'];

        $stmt = $pdo->prepare("INSERT INTO teams (name, country) VALUES (?, ?)");
        $stmt->execute([$team_name, $country]);
        echo 'Équipe créée avec succès';
    } elseif ($action == 'create_player') {
        $team_id = $_POST['team_id'];
        $player_name = $_POST['player_name'];
        $player_number = $_POST['player_number'];

        $stmt = $pdo->prepare("INSERT INTO players (team_id, name, number) VALUES (?, ?, ?)");
        $stmt->execute([$team_id, $player_name, $player_number]);
        echo 'Joueur créé avec succès';
    } elseif ($action == 'create_match') {
        $team1_id = $_POST['team1_id'];
        $team2_id = $_POST['team2_id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $odds_team1 = $_POST['odds_team1'];
        $odds_team2 = $_POST['odds_team2'];

        $stmt = $pdo->prepare("INSERT INTO matches (team1_id, team2_id, date, time, odds_team1, odds_team2) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$team1_id, $team2_id, $date, $time, $odds_team1, $odds_team2]);
        echo 'Match planifié avec succès';
    }
}
