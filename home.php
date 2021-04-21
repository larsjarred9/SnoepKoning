<?php
session_start();
if (empty($_SESSION['id'])) {
    header("location: logout.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snoep Koning | Home</title>
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
                        <a class="nav-link active" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="samenstellen.php">Samenstellen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bestellingen.php">Bestellingen</a>
                    </li>
                </ul>
                    <a class='nav-item nav-link' href="cart.php">Winkelmand</a>
                    <a class="btn btn-outline-success" href="logout.php" type="submit">Logout</a>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
    <!-- Hierinzetten --> 
    <div class="row row-cols-3">
                    <?php
                    $stmt = $conn->prepare("SELECT id, name, image FROM home");
                    $stmt->execute();
                    $stmt->bind_result($id, $name, $image);
                    while ($stmt->fetch()) {
                        echo '<div class="col">';
                        echo '<div class="card h-100 shadow-sm text-center">';
                        echo '<img src="images/kleuren/' . $image . '" class="card-img-top">';
                        echo '<div class="card-body">';
                        echo '<h3 class="card-title">' . $name . '</h3>';
                        echo '<input class="form-check-input" type="radio" name="kleur" ';
                        if ($id == 1) {
                            echo " checked ";
                        }
                        echo ' value="' . $id . '">';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
    </div>
</body>

</html>