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

// Set headers for JSON response
header('Content-Type: application/json');

// Create new employee
if ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_GET['id'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    
    // Prepared statement to prevent SQL injection
    $sql = "INSERT INTO employees (firstName, lastName, department, salary) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssd", $firstName, $lastName, $department, $salary);
    
    if ($stmt->execute()) {
        echo json_encode(['message' => 'New employee added successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Error adding employee']);
    }
    $stmt->close();
}

// Retrieve employee data
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepared statement to prevent SQL injection
    $sql = "SELECT firstName, lastName, department, salary FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
        echo json_encode($employee);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Employee not found']);
    }
    $stmt->close();
    exit;
}

// Update employee data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $firstName = $_POST['editFirstName'];
    $lastName = $_POST['editLastName'];
    $department = $_POST['editDepartment'];
    $salary = $_POST['editSalary'];
    
    // Prepared statement to prevent SQL injection
    $sql = "UPDATE employees SET firstName = ?, lastName = ?, department = ?, salary = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdi", $firstName, $lastName, $department, $salary, $id);
    
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Employee updated successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Error updating employee']);
    }
    $stmt->close();
    exit;
}

// Delete employee
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $id = $_GET['id'];
    
    // Prepared statement to prevent SQL injection
    $sql = "DELETE FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Employee deleted successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Error deleting employee']);
    }
    $stmt->close();
    exit;
}

// Close connection
$conn->close();
?>
