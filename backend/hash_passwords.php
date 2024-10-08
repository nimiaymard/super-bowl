<?php
require_once '../backend/db_connection.php'; 

// Select users whose passwords are not hashed

$stmt = $pdo->query("SELECT id, password FROM users WHERE CHAR_LENGTH(password) < 60");
$users = $stmt->fetchAll();

foreach ($users as $user) {
    $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->execute([$hashed_password, $user['id']]);
}

echo 'Passwords have been successfully hashed.'
;
?>
