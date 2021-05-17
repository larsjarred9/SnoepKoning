<?php

session_start();
include 'database.php';
require 'classes.php';

$data =  serialize($_SESSION['snoepjes']);
$id = $_SESSION['id'];

$stmt = $conn->prepare("INSERT INTO bestellingen (userid, data) VALUES (?,?)");
$stmt->bind_param("is", $id, $data);
$stmt->execute();
$stmt->close();

unset($_SESSION['snoepjes']);
header('location: ../bestellingen.php');


// $to = base64_encode(serialize($array)); // to string
// $from = unserialize(base64_decode($array)); // to object class

?>