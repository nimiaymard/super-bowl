<?php
$to = 'recipient@example.com';
$subject = 'Test Email from XAMPP';
$message = 'This is a test email sent from XAMPP using sendmail.';
$headers = 'From: nimichristbert@gmail.com' . "\r\n" .
           'Reply-To: nimichristbert@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully!';
} else {
    echo 'Failed to send email.';
}
?>
