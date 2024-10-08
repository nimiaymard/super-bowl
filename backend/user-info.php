<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['user_id'])) {
    $user_info = [
        'id' => $_SESSION['user_id'],
        'email' => $_SESSION['user_email'],
        'firstname' => $_SESSION['user_firstname'],
        'lastname' => $_SESSION['user_lastname']
    ];
    echo json_encode(['user' => $user_info]);
} else {
    echo json_encode(['error' => 'Utilisateur non connecté']);
}
?>



