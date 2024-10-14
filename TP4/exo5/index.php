<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API User Management</title>
</head>
<body>
    <h1>User Management Interface</h1>

    <!-- Form for GET all users -->
    <h2>View All Users</h2>
    <form method="GET" action="api/users.php">
        <input type="submit" value="Get All Users">
    </form>

    <!-- Form for GET a single user -->
    <h2>View Single User</h2>
    <form method="GET" action="api/users.php">
        <label for="getUserId">User ID: </label>
        <input type="number" id="getUserId" name="id" required>
        <input type="submit" value="Get User">
    </form>

    <!-- Form for POST (Create new user) -->
    <h2>Create New User</h2>
    <form method="POST" action="api/users.php">
        <label for="createName">Name: </label>
        <input type="text" id="createName" name="name" required>
        <br><br>
        <label for="createEmail">Email: </label>
        <input type="email" id="createEmail" name="email" required>
        <br><br>
        <input type="submit" value="Create User">
    </form>

    <!-- Form for PUT (Update user) -->
    <h2>Update User</h2>
    <form method="POST" action="api/users.php?id=" onsubmit="this.action += document.getElementById('updateUserId').value; this._method.value = 'PUT';">
        <input type="hidden" name="_method" value="">
        <label for="updateUserId">User ID: </label>
        <input type="number" id="updateUserId" name="id" required>
        <br><br>
        <label for="updateName">Name: </label>
        <input type="text" id="updateName" name="name" required>
        <br><br>
        <label for="updateEmail">Email: </label>
        <input type="email" id="updateEmail" name="email" required>
        <br><br>
        <input type="submit" value="Update User">
    </form>

    <!-- Form for DELETE user -->
    <h2>Delete User</h2>
    <form method="POST" action="api/users.php?id=" onsubmit="this.action += document.getElementById('deleteUserId').value; this._method.value = 'DELETE';">
        <input type="hidden" name="_method" value="">
        <label for="deleteUserId">User ID: </label>
        <input type="number" id="deleteUserId" name="id" required>
        <input type="submit" value="Delete User">
    </form>
</body>
</html>
