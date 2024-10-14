<?php
require_once('config.php');


$connectionString = "mysql:host=" . _MYSQL_HOST;
if (defined('_MYSQL_PORT') && _MYSQL_PORT != '') {
    $connectionString .= ";port=" . _MYSQL_PORT;
}
$connectionString .= ";dbname=" . _MYSQL_DBNAME;


$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

$pdo = null;
try {

    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
} catch (PDOException $error) {
    echo 'Error: ' . $error->getMessage();
}

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt->execute(['name' => $name, 'email' => $email]);

    header("Location: users.php"); 
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email]);

    header("Location: users.php"); 
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);

    header("Location: users.php"); 
}

$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
</head>
<body>
    <h1>User Management</h1>
    <h2>Add New User</h2>
    <form method="POST" action="users.php">
        <input type="text" name="name" placeholder="Name" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="submit" name="create" value="Add User" />
    </form>

    <h2>Users List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
                <td>
                    <a href="users.php?edit=<?= $user->id ?>">Edit</a>
                    <a href="users.php?delete=<?= $user->id ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if (isset($_GET['edit'])): ?>
        <?php
        $id = $_GET['edit'];
        $user = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $user->execute(['id' => $id]);
        $user = $user->fetch(PDO::FETCH_OBJ);
        ?>
        <h2>Edit User</h2>
        <form method="POST" action="users.php">
            <input type="hidden" name="id" value="<?= $user->id ?>" />
            <input type="text" name="name" value="<?= $user->name ?>" required />
            <input type="email" name="email" value="<?= $user->email ?>" required />
            <input type="submit" name="update" value="Update User" />
        </form>
    <?php endif; ?>
</body>
</html>

<?php
$pdo = null;
?>
