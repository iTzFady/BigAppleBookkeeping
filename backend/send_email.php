<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST["subject"]);
    $phoneNumber = htmlspecialchars($_POST["phoneNumber"]);
    $message = htmlspecialchars($_POST["message"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }
}
$mail = new PHPMailer(true);

try {
$mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'fadyfady2152@gmail.com';
    $mail->Password = 'lgrl yrsn yebw mdgp';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 25;
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ],
    ];
    $mail->setFrom($email, $name);
    $mail->addAddress("fadyfady215@hotmail.com"); 
    $mail->addReplyTo($email, $name);
    $mail->Subject = $subject;
    $mail->Body = "You have received a new consultation request.\n\n".
                         "Name: $name\n".
                         "Email: $email\n".
                         "Phone Number: $phoneNumber\n".
                         "\n$message";;

    $mail->send();
    echo 'Message sent successfully!';
} catch (Exception $e) {
    echo "Message could not be sent. Error: {$mail->ErrorInfo}";
}
?>
