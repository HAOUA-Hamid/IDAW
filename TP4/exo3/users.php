<?php
require_once('config.php');

$connectionString = "mysql:host=". _MYSQL_HOST;
if(defined('_MYSQL_PORT')) $connectionString .= ";port=". _MYSQL_PORT;
$connectionString .= ";dbname=" . _MYSQL_DBNAME;

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$pdo = NULL;
try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo 'Error: '.$error->getMessage();
}

$request = $pdo->prepare("SELECT * FROM users");
$request->execute();
$results = $request->fetchAll(PDO::FETCH_OBJ);

echo '<table border="1"><tr><th>ID</th><th>Name</th><th>Email</th></tr>';
foreach ($results as $user) {
    echo "<tr><td>{$user->id}</td><td>{$user->name}</td><td>{$user->email}</td></tr>";
}
echo '</table>';

$pdo = null;
