<?php
include 'database.php';
require 'classes.php';

if(empty($_GET['id'])) {
    header('location: ../admin/kleur.php');
    return false;
}


$id = $_GET['id'];
$disable = 0;

$stmt = $conn->prepare("UPDATE kleuren SET enabled = ? WHERE id = ?");
$stmt->bind_param("ii", $disable, $id);
$stmt->execute();
$stmt->close();
header('location: ../admin/kleur.php');
return false;