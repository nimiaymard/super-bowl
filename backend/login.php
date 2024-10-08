<?php
session_start();
require_once '../backend/db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user exists

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Correct password, start the session

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_firstname'] = $user['firstname'];
        $_SESSION['user_lastname'] = $user['lastname'];
        echo 'Connexion réussie';
       
        // Redirect to the user dashboard

        header("Location: ../public/user-space.html");
        exit;
    } else {
        echo 'Email ou mot de passe incorrect.';
    }
} else {
    echo 'Méthode de requête non valide.';
}
?>