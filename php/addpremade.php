<?php
session_start();
if (empty($_SESSION['id'])) {
    header("location: logout.php");
}
include 'database.php';
require 'classes.php';

if(empty($_GET['id'])) {
    header('location: ../home.php');
    return false;
}
else {
    $id = (int)$_SESSION['id'];
    $stmt = $conn->prepare("SELECT vormid, kleurid, smaakid FROM premade WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($vorm, $kleur, $smaak);
    $stmt->fetch();
    $stmt->close();

    if(!empty($vorm)) {
    $_SESSION['snoepjes'][] = serialize(new Snoepjes($vorm, $kleur, $smaak));
        header("location: ../cart.php");
    }
    else {
        header('location: ../home.php');
        return false;
    }
    
}
?>