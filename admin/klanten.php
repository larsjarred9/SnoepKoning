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

$stmt = $conn->prepare("SELECT id, voornaam, achternaam, bedrijfsnaam, telefoon, straatnaam, postcode, plaats FROM klanten ORDER BY ID ASC");
$stmt->execute();
$klanten = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snoep Koning | Smaak Opties</title>
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="voorgemaakte.php">Voorgemaakt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vorm.php">Vorm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="kleur.php">Kleur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="smaak.php">Smaak</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="klanten.php">Klanten</a>
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
            <button class='btn btn-sm btn-secondary float-end' type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Klant Aanmaken</button>
                Klanten Beheer
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Voornaam</th>
                            <th scope="col">Achternaam</th>
                            <th scope="col">Bedrijfsnaam</th>
                            <th scope="col">Telefoon</th>
                            <th scope="col">Straatnaam</th>
                            <th scope="col">Postcode</th>
                            <th scope="col">Plaats</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($klanten as $item) {
                            echo "<tr><th scope='row'>{$item['id']}</th><td>{$item['voornaam']}</td><td>{$item['achternaam']}</td><td>{$item['bedrijfsnaam']}</td><td>{$item['telefoon']}</td><td>{$item['straatnaam']}</td><td>{$item['postcode']}</td><td>{$item['plaats']}</td><td><a href='' class='btn btn-primary'>Verwijderen</a></td></tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Klant Aanmaken</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="../php/createklant.php">
                    <div class="modal-body">
                        <label>Voornaam</label>
                        <input required type="text" name="voornaam" class='form-control'>
                        <label>Achternaam</label>
                        <input required type="text" name="achternaam" class='form-control'>
                        <label>Bedrijfsnaam</label>
                        <input required type="text" name="bedrijfsnaam" class='form-control'>
                        <label>Telefoon</label>
                        <input required type="text" name="telefoon" class='form-control'>
                        <label>Straatnaam</label>
                        <input required type="text" name="straatnaam" class='form-control'>
                        <label>Postcode</label>
                        <input required type="text" name="postcode" class='form-control'>
                        <label>Woonplaats</label>
                        <input required type="text" name="plaats" class='form-control'>
                        <label>Username</label>
                        <input required type="text" name="username" class='form-control'>
                        <label>Email</label>
                        <input required type="email" name="email" class='form-control'>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Aanmaken</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>