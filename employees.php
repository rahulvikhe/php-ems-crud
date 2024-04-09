<?php
// Include the server.php file to access the database connection
include 'server.php';
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
      <!-- Employee data will be dynamically inserted here -->
    </tbody>
  </table>

  <!-- Modal for editing employee details -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <span class="close-button">&times;</span>
      <h3>Edit Employee</h3>
      <form id="editForm">
        <label for="editFirstName">First Name:</label>
        <input type="text" id="editFirstName" name="editFirstName" required>
        <label for="editLastName">Last Name:</label>
        <input type="text" id="editLastName" name="editLastName" required>
        <label for="editDepartment">Department:</label>
        <input type="text" id="editDepartment" name="editDepartment">
        <label for="editSalary">Salary:</label>
        <input type="number" id="editSalary" name="editSalary" required>
        <input type="hidden" id="editId" name="editId">
        <button type="submit">Save</button>
      </form>
    </div>
  </div>

  <script src="employees.js"></script>
</body>
</html>