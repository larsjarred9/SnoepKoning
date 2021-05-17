
<?php
session_start();

if(empty($_GET['id'])) {
    echo "Something went wrong";
}
$id = $_GET['id'];

unset($_SESSION['snoepjes'][$id]);
header('location: ../cart.php');

?>