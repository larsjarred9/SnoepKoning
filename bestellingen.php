<?php
session_start();
if (empty($_SESSION['id'])) {
    header("location: logout.php");
}
if (!empty($_SESSION['admin'])) {
    header("location: logout.php");
}
include 'php/database.php';
require 'php/classes.php';

function getVorm($conn, $vorm)
{
    $stmt = $conn->prepare("SELECT name FROM vormen WHERE id = ?");
    $stmt->bind_param("i", $vorm);
    $stmt->execute();
    $stmt->bind_result($vorm);
    $stmt->fetch();
    $stmt->close();
    return $vorm;
}
function getSmaak($conn, $smaak)
{
    $stmt = $conn->prepare("SELECT name FROM smaak WHERE id = ?");
    $stmt->bind_param("i", $smaak);
    $stmt->execute();
    $stmt->bind_result($smaak);
    $stmt->fetch();
    $stmt->close();
    return $smaak;
}
function getKleur($conn, $kleur)
{
    $stmt = $conn->prepare("SELECT name FROM kleuren WHERE id = ?");
    $stmt->bind_param("i", $kleur);
    $stmt->execute();
    $stmt->bind_result($kleur);
    $stmt->fetch();
    $stmt->close();
    return $kleur;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snoep Koning | Bestellingen</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="images/juke_favicon.png" />
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
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="samenstellen.php">Samenstellen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="bestellingen.php">Bestellingen</a>
                    </li>
                </ul>
                <a class='nav-item nav-link' href="cart.php">Winkelmand</a>
                <a class="btn btn-outline-success" href="logout.php" type="submit">Logout</a>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Bestellingen</span>
                </h4>
                <form method="post" action="php/addtocart.php">
                    <ul class="list-group mb-3">
                        <?php
                        $id = $_SESSION['id'];
                        $productcount = [];
                        $snoepjesarray = [];
                        $datumarray = [];
                        $statusarray = [];


                        $stmt = $conn->prepare("SELECT COUNT(*) FROM bestellingen WHERE userid = ?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $stmt->bind_result($amountofbestellingen);
                        $stmt->fetch();
                        $stmt->close();

                        $stmt = $conn->prepare("SELECT data, datetime, status FROM bestellingen WHERE userid = ? ORDER BY ID DESC");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $stmt->bind_result($data, $datetime, $status);
                        while ($stmt->fetch()) {
                            $array = unserialize($data);
                            array_push($snoepjesarray, $array);
                            array_push($productcount, count($array));
                            array_push($datumarray, $datetime);
                            array_push($statusarray, $status);
                        }
                        $stmt->close();
                        if (empty($productcount)) {
                            echo "<p>Je hebt nog geen bestellingen geplaatst.</p>";
                        }

                        // For every bestelling
                        for ($y = 0; $y < $amountofbestellingen; $y++) {
                            $countproducts = $productcount[$y];
                            $array = $snoepjesarray[$y];
                            // Fetch snoepjes
                            for ($x = 0; $x < $countproducts; $x++) {
                                $snoepjes = unserialize($array[$x]);
                                $vorm = getVorm($conn, $snoepjes->vorm);
                                $smaak = getSmaak($conn, $snoepjes->smaak);
                                $kleur = getKleur($conn, $snoepjes->kleur);
                                echo '<li class="list-group-item d-flex justify-content-between lh-sm">';
                                echo '<div>';
                                echo '<h6 class="my-0">Snoep ' . $vorm . ' | <small>50 KG</small></h6>';
                                echo '<small class="text-muted">Kleur: ' . $kleur . '</small><br>';
                                echo '<small class="text-muted">Smaak: ' . $smaak . '</small><br><br>';
                                echo '<small class="text-muted">Datum: ' . $datumarray[$y] . '</small><br>';
                                if ($statusarray[$y] != 1) {
                                    echo '<small class="text-white badge bg-secondary">Verzonden</small>';
                                }
                                echo '</div>';
                                echo '<span class="text-muted">€75</span>';
                                echo '</li>';
                            }
                        }
                        ?>
                    </ul>
                </form>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>