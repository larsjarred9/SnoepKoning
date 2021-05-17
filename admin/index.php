<?php
session_start();
if (empty($_SESSION['id'])) {
    header("location: logout.php");
}
if (empty($_SESSION['admin'])) {
    header("location: logout.php");
}
include '../php/database.php';
require '../php/classes.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snoep Koning | Admin Home</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="../images/juke_favicon.png" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Snoep Koning</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="voorgemaakte.php">Voorgemaakt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vorm.php">Vorm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kleur.php">Kleur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="smaak.php">Smaak</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="klanten.php">Klanten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bestellingen.php">Bestellingen</a>
                    </li>
                </ul>
                <a class="btn btn-outline-success" href="../logout.php" type="submit">Logout</a>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
            Welkom!
            </div>
            <div class="card-body">
            <p>In dit dashboard kunt u klanten & bestellingen beheren. Verder kunt u het samenstellinsproces van snoep weizigen. En voorgemaakte snoepjes toevoegen aan de homepage van het klanten paneel.</p>
            </div>
        </div>
    </div>
</body>
</html>
