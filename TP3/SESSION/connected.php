<?php
session_start(); 
$users = array(
    'riri' => 'fifi',
    'yoda' => 'maitrejedi'
);

if (isset($_POST['login']) && isset($_POST['password'])) {
    $tryLogin = $_POST['login'];
    $tryPwd = $_POST['password'];
    if (array_key_exists($tryLogin, $users) && $users[$tryLogin] == $tryPwd) {
        $_SESSION['login'] = $tryLogin;
        header("Location: welcome.php");
        exit(); 
    } else {
        echo "Erreur de login/password. <a href='login.php'>Réessayer</a>";
    }
} else {
    echo "Merci d'utiliser le formulaire de login. <a href='login.php'>Retour au login</a>";
}
?>
