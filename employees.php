<?php
// Fetch and display registered employee data
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registered Employees</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h2>Registered Employees</h2>
    <table id="employeeTable">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Department</th>
          <th>Salary</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["firstName"] . "</td>";
                echo "<td>" . $row["lastName"] . "</td>";
                echo "<td>" . $row["department"] . "</td>";
                echo "<td>$" . $row["salary"] . "</td>";
                echo "<td>
                        <button class='edit-button' data-id='" . $row["id"] . "'>Edit</button>
                        <button class='delete-button' data-id='" . $row["id"] . "'>Delete</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No employees registered</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <script src="app.js"></script>
</body>
</html>

<?php
$conn->close();
?>
