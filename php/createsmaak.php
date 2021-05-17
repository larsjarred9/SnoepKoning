<?php
include 'database.php';
require 'classes.php';

if (!file_exists($_FILES["image"]["tmp_name"])) {
    header('location: ../admin/smaak.php?wrong=noimg');
    return false;
}
$tmpFilePath = $_FILES["image"]["tmp_name"];
$filename = $_FILES["image"]["name"];
$filename = htmlspecialchars($filename, ENT_QUOTES);
$fileExt = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
$filename = htmlspecialchars($filename, ENT_QUOTES);

$stmt = $conn->prepare("SELECT MAX(id) FROM smaak");
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();
$stmt->close();

$id++;

$name = $_POST['naam'];

if ($tmpFilePath != "") {
    $newName = "smaak_" . $id . "." . $fileExt;
    $newFilePath = "D:/xampp/htdocs/school/snoepkoning/images/smaaken/" . $newName;
    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
        $stmt = $conn->prepare("INSERT INTO smaak (name, image) VALUES (?,?)");
        $stmt->bind_param("ss", $name, $newName);
        $stmt->execute();
        $stmt->close();
        header('location: ../admin/smaak.php');
    } else {
        header('location: ../admin/smaak.php?wrong=move');
        return false;
    }
} else {
    header('location: ../admin/smaak.php?wrong=notemp');
    return false;
}
