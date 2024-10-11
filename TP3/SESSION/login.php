<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login Form</h2>
    <form id="login_form" action="connected.php" method="POST">
        <table>
            <tr>
                <th>Login :</th>
                <td><input type="text" name="login" required></td>
            </tr>
            <tr>
                <th>Password :</th>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Se connecter..."></td>
            </tr>
        </table>
    </form>
</body>
</html>
