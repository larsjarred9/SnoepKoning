<?php
include 'database.php';
require 'classes.php';

if(empty($_GET['id'])) {
    header('location: ../admin/bestellingen.php');
    return false;
}

$id = $_GET['id'];
$disable = 0;

$stmt = $conn->prepare("UPDATE bestellingen SET status = ? WHERE id = ?");
$stmt->bind_param("ii", $disable, $id);
$stmt->execute();
$stmt->close();
header('location: ../admin/bestellingen.php');
    return false;
?>