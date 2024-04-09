// Fetch and display employee data
function fetchEmployeeData() {
  fetch('server.php')
    .then(response => response.json())
    .then(data => {
      const employeeTable = document.getElementById('employeeTable');
      const tbody = employeeTable.getElementsByTagName('tbody')[0];
      tbody.innerHTML = ''; // Clear previous data before appending new data

      data.forEach(employee => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${employee.firstName}</td>
          <td>${employee.lastName}</td>
          <td>${employee.department}</td>
          <td>$${employee.salary}</td>
          <td>
            <button class="edit-button" data-id="${employee.id}">Edit</button>
            <button class="delete-button" data-id="${employee.id}">Delete</button>
          </td>
        `;
        tbody.appendChild(row);
      });

      addEditEventListeners();
      addDeleteEventListeners();
    })
    .catch(error => {
      console.error('Error fetching employee data:', error);
    });
}

// Add event listener for the edit button
function addEditEventListeners() {
  const employeeTable = document.getElementById('employeeTable');
  employeeTable.addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('edit-button')) {
      showEditModal(event);
    }
  });
}

// Show the edit modal and populate the form
function showEditModal(event) {
  const employeeId = event.target.dataset.id;
  const editModal = document.getElementById('editModal');
  editModal.style.display = 'block';

  // Fetch the employee data for the selected employee
  fetch(`server.php?id=${employeeId}`)
    .then(response => response.json())
    .then(employee => {
      document.getElementById('editFirstName').value = employee.firstName;
      document.getElementById('editLastName').value = employee.lastName;
      document.getElementById('editDepartment').value = employee.department;
      document.getElementById('editSalary').value = employee.salary;
      document.getElementById('editId').value = employee.id;
    })
    .catch(error => {
      console.error('Error fetching employee data:', error);
    });
}

// Add event listener for the delete button
function addDeleteEventListeners() {
  const employeeTable = document.getElementById('employeeTable');
  employeeTable.addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('delete-button')) {
      deleteEmployee(event);
    }
  });
}

// Delete an employee
function deleteEmployee(event) {
  const employeeId = event.target.dataset.id;
  fetch(`server.php?id=${employeeId}`, {
    method: 'DELETE'
  })
    .then(response => response.json())
    .then(data => {
      console.log('Employee deleted:', data);
      fetchEmployeeData(); // Refresh the employee table
    })
    .catch(error => {
      console.error('Error deleting employee:', error);
    });
}

// Initialize the page
fetchEmployeeData();
