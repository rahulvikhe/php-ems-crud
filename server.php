<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO employees (firstName, lastName, department, salary) VALUES ('$firstName', '$lastName', '$department', $salary)";

    if ($conn->query($sql) === TRUE) {
        echo "New employee added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT firstName, lastName, department, salary FROM employees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Employee Name: " . $row["firstName"] . " " . $row["lastName"] . "<br>";
        echo "Department: " . $row["department"] . "<br>";
        echo "Salary: $" . $row["salary"] . "<br><br>";
    }
} else {
    echo "No employees found";
}

$conn->close();
?>
