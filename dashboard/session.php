<?php
session_start();

$inactive = 300;
if (!isset($_SESSION['timeout']))
    $_SESSION['timeout'] = time() + $inactive;

$session_life = time() - $_SESSION['timeout'];

if ($session_life > $inactive) {
    session_destroy();
    header("Location:../index.php");
}

$_SESSION['timeout'] = time();

if (!isset($_SESSION["user_name"]) && $_SESSION['status'] == "Active") {
    session_destroy();
    header("location: ../index.php");
}
