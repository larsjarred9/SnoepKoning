<?php
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0; # 0 off, 1 client, 2 client y server
$mail->CharSet  = 'UTF-8';
$mail->Host = 'contadoro.com';
$mail->Port = 25;
$mail->SMTPSecure = 'tls'; # SSL is deprecated
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer'  => true,
        'verify_depth' => 3,
        'allow_self_signed' => true,
        'peer_name' => 'Plesk',
    )
);

$mail->SMTPAuth = true;
$mail->Username = 'noreply@contadoro.com';
$mail->Password = 'Ta83wb!5';
$mail->setFrom('noreply@contadoro.com', 'Contadoro');

include 'database.php';
require 'classes.php';

if (empty($_POST['email'])) {
    header('location: ../admin/klanten.php');
    return false;
}
$username = $_POST['username'];
$voornaam = $_POST['voornaam'];
$achternaam = $_POST['achternaam'];
$bedrijfsnaam = $_POST['bedrijfsnaam'];
$telefoon = $_POST['telefoon'];
$straatnaam = $_POST['straatnaam'];
$postcode = $_POST['postcode'];
$plaats = $_POST['plaats'];
$email = $_POST['email'];


$passwordold = uniqid();
$password = password_hash($passwordold, PASSWORD_BCRYPT);

// Create User
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?,?)");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->close();

// Get Userid
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();
$stmt->close();

// Create Klant
$stmt = $conn->prepare("INSERT INTO klanten (id, voornaam, achternaam, bedrijfsnaam, telefoon, straatnaam, postcode, plaats) VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param("isssssss", $id, $voornaam, $achternaam, $bedrijfsnaam, $telefoon, $straatnaam, $postcode, $plaats);
$stmt->execute();
$stmt->close();

// Send Email
$mail->addAddress($email);
$mail->Subject = "Snoepkoning | Klant Account aangemaakt";
$mail->Body = "Welkom bij de snoepkoning u kunt inloggen met de gebruikersnaam {$username} met het desbetreffende wachtwoord {$passwordold}";
$mail->IsHTML(true);
$mail->send();

header('location: ../admin/klanten.php');
return false;
