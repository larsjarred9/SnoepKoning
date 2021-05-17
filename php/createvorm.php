<?php
include 'database.php';
require 'classes.php';

if (!file_exists($_FILES["image"]["tmp_name"])) {
    header('location: ../admin/vorm.php?wrong=noimg');
    return false;
}
$tmpFilePath = $_FILES["image"]["tmp_name"];
$filename = $_FILES["image"]["name"];
$filename = htmlspecialchars($filename, ENT_QUOTES);
$fileExt = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
$filename = htmlspecialchars($filename, ENT_QUOTES);

$stmt = $conn->prepare("SELECT MAX(id) FROM vormen");
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();
$stmt->close();

$id++;

$name = $_POST['naam'];

if ($tmpFilePath != "") {
    $newName = "vorm" . $id . "." . $fileExt;
    $newFilePath = "D:/xampp/htdocs/school/snoepkoning/images/vormen/" . $newName;
    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
        $stmt = $conn->prepare("INSERT INTO vormen (name, image) VALUES (?,?)");
        $stmt->bind_param("ss", $name, $newName);
        $stmt->execute();
        $stmt->close();
        header('location: ../admin/vorm.php');
    } else {
        header('location: ../admin/vorm.php?wrong=move');
        return false;
    }
} else {
    header('location: ../admin/vorm.php?wrong=notemp');
    return false;
}
