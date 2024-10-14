<?php
session_start();

if (isset($_SESSION['login'])) {
    echo "<h1>Bienvenu, " . $_SESSION['login'] . "!</h1>";
    echo "<a href='logout.php'>Se déconnecter</a>";
} else {
    header("Location: login.php");
    exit();
}

