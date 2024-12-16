<!-- Created By DanishLam -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link rel="stylesheet" href="admin.css">
    <title>Admin Page</title>
</head>
<body>
    <div class="container">
        <div class="topbar">
            <div class="logo">
                <h2>WebTribe</h2>
            </div>
        </div>
        <div class="sidebar">
            <ul>
                <li><a href="#dashboard"><span class="material-symbols-outlined">donut_large</span><div>Dashboard</div></a></li>
                <li><a href="#students"><span class="material-symbols-outlined">school</span><div>Students</div></a></li>
                <li><a href="#teachers"><span class="material-symbols-outlined">person</span><div>Teachers</div></a></li>
                <li><a href="#employees"><span class="material-symbols-outlined">groups</span><div>Employees</div></a></li>
                <li><a href="#analytics"><span class="material-symbols-outlined">monitoring</span><div>Analytics</div></a></li>
                <li><a href="#earning"><span class="material-symbols-outlined">payments</span><div>Earnings</div></a></li>
                <li><a href="#help"><span class="material-symbols-outlined">help</span><div>Help</div></a></li>
            </ul>
        </div>

        <div class="main">
        <section id="dashboard">
            <h2>Dashboard Overview</h2>
            <div class="cards">
                <div class="card"><div class="number students-count">0</div><div class="card-name">Students</div></div>
                <div class="card"><div class="number teachers-count">0</div><div class="card-name">Teachers</div></div>
                <div class="card"><div class="number employees-count">0</div><div class="card-name">Employees</div></div>
                <div class="card"><div class="number earnings-count">RM 0</div><div class="card-name">Earning</div></div>
            </div>
            
        </section>

            <section id="students">
                <h2>Students Management</h2>
                <button id="addStudentButton">Add Student</button>
                <button id="deleteStudentButton">Delete Student</button>
            </section>

            <!-- Teachers Section -->
            <section id="teachers">
                <h2>Teachers Management</h2>
                <button id="addTeacherButton">Add Teacher</button>
                <button id="deleteTeacherButton">Delete Teacher</button>
            </section>

            <!-- Employees Section -->
            <section id="employees">
                <h2>Employees Management</h2>
                <button id="addEmployeeButton">Add Employee</button>
                <button id="deleteEmployeeButton">Delete Employee</button>
            </section>

            <!-- Analytics Section -->
            <section id="analytics">
                <h2>Analytics</h2>
                <div class="chart-container">
                    <canvas id="earningChart"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="employeeChart"></canvas>
                </div>
            </section>

            <!-- Earnings Section -->
            <section id="earning">
                <h2>Earnings</h2>
                <button id="addEarningButton">Add Earnings</button>
                <button id="deleteEarningButton">Delete Earnings</button>

            </section>

            <!-- Help Section -->
            <section id="help">
                <h2>Help / FAQ</h2>
                <p>Here are some frequently asked questions:</p>
                <ul>
                    <li>How do I add a student? Click on the "Add Student" button under the Students section.</li>
                    <li>How do I view analytics? Navigate to the Analytics section in the sidebar.</li>
                </ul>
            </section>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="admin.js"></script>
</body>
</html>
