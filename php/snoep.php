<?php
session_start();


if (empty($_POST['submit'])) {
    if (empty($_SESSION['vorm'])) {
        $_SESSION['vorm'] = $_POST['vorm'];
        if (!empty($_POST['vorm'])) {
            $_SESSION['vormvar'] = $_POST['vorm'];
        }
        header('location: ../samenstellen.php');
        exit();
    }
    if (empty($_SESSION['kleur'])) {
        $_SESSION['kleur'] = $_POST['kleur'];
        if (!empty($_POST['kleur'])) {
        $_SESSION['kleurvar'] = $_POST['kleur'];
        }
        header('location: ../samenstellen.php');
        exit();
    }
    if (empty($_SESSION['smaak'])) {
        $_SESSION['smaak'] = $_POST['smaak'];
        if (!empty($_POST['smaak'])) {
            $_SESSION['smaakvar'] = $_POST['smaak'];
        }
        header('location: ../samenstellen.php');
        exit();
    }
} else {
    if (!empty($_POST['submit'])) {
        if (!empty($_SESSION['smaak'])) {
            unset($_SESSION['smaak']);
            header('location: ../samenstellen.php');
            exit();
        }

        if (!empty($_SESSION['kleur'])) {
            unset($_SESSION['kleur']);
            header('location: ../samenstellen.php');
            exit();

        }
        if (!empty($_SESSION['vorm'])) {
            unset($_SESSION['vorm']);
            header('location: ../samenstellen.php');
            exit();
        }
    }
}
