<?php
require_once '../backend/db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
// Password hashing
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Check if the email already exists

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo 'Cet email est déjà utilisé.';
        exit;
    }

// Insert the new user

    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$firstname, $lastname, $email, $hashed_password])) {
        //echo 'Account successfully created';
        echo 'Account successfully created. Please check your email to confirm your registration.';
        // Disable sending confirmation email
        // Sending the confirmation email
        
        mail($email,"Confirmation of your registration", "Thank you for signing up. Please click on the following link to confirm your registration: [confirmation link]"
);
    } else {
        echo 'Error creating account. Please try again.'
;
    }
}
?>


