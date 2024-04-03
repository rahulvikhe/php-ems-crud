<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the external CSS file -->
</head>
<body>
    <h2>Update Employee Details</h2>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $department = $_POST['department'];
        $salary = $_POST['salary'];

        $sql = "UPDATE employees SET firstName='$firstName', lastName='$lastName', department='$department', salary=$salary WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Employee details updated successfully";
        } else {
            echo "Error updating employee details: " . $conn->error;
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM employees WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <form action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" value="<?php echo $row['firstName']; ?>" required>
                <br>
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo $row['lastName']; ?>" required>
                <br>
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" value="<?php echo $row['department']; ?>">
                <br>
                <label for="salary">Salary:</label>
                <input type="number" id="salary" name="salary" value="<?php echo $row['salary']; ?>" required>
                <br>
                <input type="submit" value="Update">
            </form>
    <?php
        } else {
            echo "Employee not found";
        }
    }

    $conn->close();
    ?>
</body>
</html>
