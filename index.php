<!DOCTYPE html>
<?php 
session_start();
if (!empty($_SESSION['id'])) {
    header("location: home.php");
}

include "php/database.php";

if(!empty($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $password_filter);
    $stmt->fetch();
    $stmt->close();

    if(empty($id)) {
        echo "Username bestaat niet.<br><a href=''>Terug</a>";
        exit();
    }
    else {
        if (password_verify($password, $password_filter)) {
            $_SESSION['id'] = $id;
            header('location: home.php');
        }
        else {
            echo "Wachtwoord is incorrect.<br><a href=''>Terug</a>";
            exit();
        }
    }

}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snoep Koning | Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="images/juke_favicon.png" />
</head>

<body>
    <main class="form-signin text-center">
        <form method="POST" action="">
            <img class="mb-4" src="images/logo.png">
            <h1 class="h3 mb-3 fw-normal">Login</h1>

            <div class="form-floating">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Gebruikersnaam">
                <label for="floatingInput">Gebruikersnaam</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Wachtwoord</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Inloggen</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
        </form>
    </main>
</body>

</html>
<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>