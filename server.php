<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create new employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_GET['id'])) {
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $department = $conn->real_escape_string($_POST['department']);
    $salary = $conn->real_escape_string($_POST['salary']);

    $sql = "INSERT INTO employees (firstName, lastName, department, salary) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssd", $firstName, $lastName, $department, $salary);

    if ($stmt->execute()) {
        echo "New employee added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

// Retrieve employee data
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT id, firstName, lastName, department, salary FROM employees";
    $result = $conn->query($sql);
    $employees = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
    }
    echo json_encode($employees);
    exit;
}

// Update employee data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $firstName = $conn->real_escape_string($_POST['editFirstName']);
    $lastName = $conn->real_escape_string($_POST['editLastName']);
    $department = $conn->real_escape_string($_POST['editDepartment']);
    $salary = $conn->real_escape_string($_POST['editSalary']);

    $sql = "UPDATE employees SET firstName = ?, lastName = ?, department = ?, salary = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdi", $firstName, $lastName, $department, $salary, $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Employee updated successfully']);
    } else {
        echo json_encode(['error' => 'Error updating employee: ' . $conn->error]);
    }

    $stmt->close();
    exit;
}

// Delete employee
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "DELETE FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Employee deleted successfully']);
    } else {
        echo json_encode(['error' => 'Error deleting employee: ' . $conn->error]);
    }

    $stmt->close();
    exit;
}

$conn->close();
?>