// Made By DanishLam
// =======================
// Fetch data from PHP backend
// =======================
let studentCount = 0, teacherCount = 0, employeeCount = 0; // Variables to hold counts

document.addEventListener('DOMContentLoaded', () => {
    fetch('admin_data.php')
        .then(response => response.json())
        .then(data => {
            // Update top boxes dynamically
            const dashboardCounts = data.dashboardCounts;

            // Dynamically initialize counts from the backend
            studentCount = dashboardCounts.find(item => item.metric === 'Students').count;
            teacherCount = dashboardCounts.find(item => item.metric === 'Teachers').count;
            employeeCount = dashboardCounts.find(item => item.metric === 'Employees').count;

            // Update the UI with the fetched values
            document.querySelector('.students-count').textContent = studentCount;
            document.querySelector('.teachers-count').textContent = teacherCount;
            document.querySelector('.employees-count').textContent = employeeCount;
            document.querySelector('.earnings-count').textContent = `RM ${dashboardCounts.find(item => item.metric === 'Earnings').count}`;

            // Populate line chart (Earnings Chart)
            const earningsData = data.earnings.map(item => item.earnings);
            const months = data.earnings.map(item => item.month);
            const ctx = document.getElementById('earningChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Earnings in RM',
                        data: earningsData,
                        backgroundColor: 'rgba(85,85,85,1)',
                        borderColor: 'rgb(41,155,99)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });

            // Populate doughnut chart (Employee Distribution)
            const employeeCounts = data.employees.map(item => item.count);
            const employeeCategories = data.employees.map(item => item.category);
            const ctx2 = document.getElementById('employeeChart').getContext('2d');
            new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: employeeCategories,
                    datasets: [{
                        label: 'Employees',
                        data: employeeCounts,
                        backgroundColor: [
                            'rgba(184, 20, 20, 0.7)',
                            'rgba(18, 116, 31, 0.7)',
                            'rgba(66, 105, 14, 0.7)',
                            'rgba(70, 4, 4, 0.7)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' },
                        title: { display: true, text: 'Employee Distribution' }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));

    // Attach Event Listeners
    attachEventListeners();

    // Initialize Sidebar Navigation
    initializeSidebar();
    setupSidebarNavigation();
});

// =======================
// Sidebar Navigation Handling
// =======================
const sidebarLinks = document.querySelectorAll('.sidebar ul li a');
const sections = document.querySelectorAll('.main section');

// Initialize sidebar visibility
function initializeSidebar() {
    sections.forEach(section => section.style.display = 'none'); // Hide all sections
    document.querySelector('#dashboard').style.display = 'block'; // Show dashboard by default
}

// Add click event listeners to sidebar links
function setupSidebarNavigation() {
    sidebarLinks.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();

            // Hide all sections
            sections.forEach(section => section.style.display = 'none');

            // Show the selected section
            const targetSection = document.querySelector(link.getAttribute('href'));
            if (targetSection) {
                targetSection.style.display = 'block';
            }
        });
    });
}

// =======================
// Attach Event Listeners for Buttons
// =======================
function attachEventListeners() {
    document.querySelector('#addStudentButton').addEventListener('click', () => updateCount('Students', 'add'));
    document.querySelector('#deleteStudentButton').addEventListener('click', () => updateCount('Students', 'delete'));
    document.querySelector('#addTeacherButton').addEventListener('click', () => updateCount('Teachers', 'add'));
    document.querySelector('#deleteTeacherButton').addEventListener('click', () => updateCount('Teachers', 'delete'));
    document.querySelector('#addEmployeeButton').addEventListener('click', () => updateCount('Employees', 'add'));
    document.querySelector('#deleteEmployeeButton').addEventListener('click', () => updateCount('Employees', 'delete'));
    document.querySelector('#addEarningButton').addEventListener('click', addEarning);
    document.querySelector('#deleteEarningButton').addEventListener('click', deleteEarning);
}

// =======================
// Update Counts (Students, Teachers, Employees)
// =======================
function updateCount(metric, action) {
    const count = prompt(`Enter the number of ${metric.toLowerCase()} to ${action}:`).trim();
    if (count && !isNaN(count) && parseInt(count) > 0) {
        fetch('update_data_admin.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ metric, action, count: parseInt(count) })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(`${metric} count successfully updated!`);
                location.reload();
            } else {
                alert(data.message || 'Failed to update.');
            }
        })
        .catch(error => console.error('Error updating count:', error));
    } else {
        alert('Please enter a valid positive number.');
    }
}

// =======================
// Add Earnings Function
// =======================
function addEarning() {
    const month = prompt('Enter the month (e.g., Jan, Feb, Mar):').trim();
    const amount = prompt('Enter the earning amount to add (in RM):').trim();

    if (month && amount && !isNaN(amount) && parseFloat(amount) > 0) {
        fetch('update_data_admin.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ metric: 'Earnings', action: 'add', month, count: parseFloat(amount) })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(`Earnings for ${month} successfully added!`);
                location.reload();
            } else {
                alert(data.message || 'Failed to add earnings.');
            }
        })
        .catch(error => console.error('Error adding earnings:', error));
    } else {
        alert('Please enter a valid month and earning amount.');
    }
}

// =======================
// Delete Earnings Function
// =======================
function deleteEarning() {
    console.log("Delete Earnings button clicked"); // Debug
    const month = prompt('Enter the month (e.g., Jan, Feb, Mar) to delete earnings:').trim();
    const amount = prompt('Enter the earning amount to delete (in RM):').trim();

    if (month && amount && !isNaN(amount) && parseFloat(amount) > 0) {
        const value = parseFloat(amount);

        fetch('update_data_admin.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                metric: 'Earnings',
                action: 'delete',
                month: month,
                count: value
            })
        })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Debug: Check server response
                if (data.status === 'success') {
                    alert(`Earnings for ${month} successfully deleted!`);
                    location.reload(); // Reload to refresh data
                } else {
                    alert(data.message || 'Failed to delete earnings.');
                }
            })
            .catch(error => console.error('Error deleting earnings:', error));
    } else {
        alert('Please enter a valid month and positive earning amount.');
    }
}