<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the external CSS file -->
</head>
<body>
    <h2>Employee Information</h2>
    <form action="server.php" method="post">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>
        <br>
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>
        <br>
        <label for="department">Department:</label>
        <input type="text" id="department" name="department">
        <br>
        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" required>
        <br>
        <input type="submit" value="Add Employee">
    </form>
</body>
</html>
