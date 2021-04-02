<?php
session_start();
if (empty($_SESSION['id'])) {
    header("location: logout.php");
}
include 'php/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snoep Koning | Samenstellen</title>
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
                        <a class="nav-link active" href="samenstellen.php">Samenstellen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bestellingen.php">Bestellingen</a>
                    </li>
                </ul>
                <button class="btn btn-outline-success" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php if (empty($_SESSION['vorm'])) { ?>
            <div class="position-relative m-4">
                <div class="progress" style="height: 1px;">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-dark rounded-pill" style="width: 2rem; height:2rem;">2</button>
                <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-dark rounded-pill" style="width: 2rem; height:2rem;">3</button>
            </div>
            <form action="" method="POST">
                <div class="text-center mb-3">
                    <input type="submit" class="btn btn-secondary btn-sm" value="Volgende Stap"></a>
                </div>
                <div class="row row-cols-3">
                    <?php
                    $stmt = $conn->prepare("SELECT id, name, image FROM vormen");
                    $stmt->execute();
                    $stmt->bind_result($id, $name, $image);
                    while ($stmt->fetch()) {
                        echo '<div class="col">';
                        echo '<div class="card h-100 shadow-sm text-center">';
                        echo '<img src="images/vormen/' . $image . '" class="card-img-top">';
                        echo '<div class="card-body">';
                        echo '<h3 class="card-title">' . $name . '</h3>';
                        echo '<input class="form-check-input" type="radio" name="vorm" ';
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
            </form>
        <?php } elseif (empty($_SESSION['kleur'])) { ?>
            <div class="position-relative m-4">
                <div class="progress" style="height: 1px;">
                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-dark rounded-pill" style="width: 2rem; height:2rem;">3</button>
            </div>
            <form action="" method="POST">
                <div class="text-center mb-3">
                    <a class="btn btn-secondary btn-sm">Volgende Stap</a>
                </div>
                <div class="row row-cols-3">
                    <?php
                    $stmt = $conn->prepare("SELECT id, name, image FROM kleuren");
                    $stmt->execute();
                    $stmt->bind_result($id, $name, $image);
                    while ($stmt->fetch()) {
                        echo '<div class="col">';
                        echo '<div class="card h-100 shadow-sm text-center">';
                        echo '<img src="images/vormen/' . $image . '" class="card-img-top">';
                        echo '<div class="card-body">';
                        echo '<h3 class="card-title">' . $name . '</h3>';
                        echo '<input class="form-check-input" type="radio" name="vorm" ';
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
            </form>
        <?php } ?>
    </div>
</body>

</html>