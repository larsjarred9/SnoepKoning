<?php
include 'database.php';
require 'classes.php';

if (!file_exists($_FILES["image"]["tmp_name"])) {
    header('location: ../admin/voorgemaakt.php?wrong=noimg');
    return false;
}
$tmpFilePath = $_FILES["image"]["tmp_name"];
$filename = $_FILES["image"]["name"];
$filename = htmlspecialchars($filename, ENT_QUOTES);
$fileExt = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
$filename = htmlspecialchars($filename, ENT_QUOTES);

$stmt = $conn->prepare("SELECT MAX(id) FROM premade");
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();
$stmt->close();

$id++;

$name = $_POST['naam'];
$vorm = $_POST['vorm'];
$kleur = $_POST['kleur'];
$smaak = $_POST['smaak'];

if ($tmpFilePath != "") {
    $newName = "premade" . $id . "." . $fileExt;
    $newFilePath = "D:/xampp/htdocs/school/snoepkoning/images/premade/" . $newName;
    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
        $stmt = $conn->prepare("INSERT INTO premade (name, vormid, kleurid, smaakid, image) VALUES (?,?,?,?,?)");
        $stmt->bind_param("siiis", $name, $vorm, $kleur, $smaak, $newName);
        $stmt->execute();
        $stmt->close();
        header('location: ../admin/voorgemaakte.php');
    } else {
        header('location: ../admin/voorgemaakte.php?wrong=move');
        return false;
    }
} else {
    header('location: ../admin/voorgemaakte.php?wrong=notemp');
    return false;
}
