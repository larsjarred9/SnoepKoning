<?php
include 'database.php';
require 'classes.php';

if(empty($_GET['id'])) {
    header('location: ../admin/klanten.php');
    return false;
}


$id = $_GET['id'];
$disable = 0;

// Klanten Accounts
$stmt = $conn->prepare("UPDATE klanten SET enabled = ? WHERE id = ?");
$stmt->bind_param("ii", $disable, $id);
$stmt->execute();
$stmt->close();

// User Accounts
$stmt = $conn->prepare("UPDATE users SET enabled = ? WHERE id = ?");
$stmt->bind_param("ii", $disable, $id);
$stmt->execute();
$stmt->close();

header('location: ../admin/klanten.php');
return false;