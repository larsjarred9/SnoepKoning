<?php
include 'database.php';
require 'classes.php';

if(empty($_GET['id'])) {
    header('location: ../admin/vorm.php');
    return false;
}


$id = $_GET['id'];
$disable = 0;

$stmt = $conn->prepare("UPDATE vormen SET enabled = ? WHERE id = ?");
$stmt->bind_param("ii", $disable, $id);
$stmt->execute();
$stmt->close();
header('location: ../admin/vorm.php');
return false;