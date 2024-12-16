<?php
include("conn.php");

$query = $conn->query("SELECT * FROM examinee_tbl ORDER BY exmne_id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <title>Manage Examinees</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="admin.html">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="manageCourses.php">Courses</a></li>
            <li class="nav-item"><a class="nav-link" href="manageExams.php">Exams</a></li>
            <li class="nav-item"><a class="nav-link" href="manageExaminees.php">Examinees</a></li>
        </ul>
    </div>
</nav>
<!-- Table Code -->
<div class="table-container">
    <table class="custom-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($query->rowCount() > 0) {
                $count = 1;
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $statusClass = ($row['exmne_status'] === 'Active') ? 'status-active' : 'status-inactive';
                    echo "<tr>
                            <td>{$count}</td>
                            <td>{$row['exmne_fullname']}</td>
                            <td>{$row['exmne_email']}</td>
                            <td><span class='status-badge {$statusClass}'>{$row['exmne_status']}</span></td>
                        </tr>";
                    $count++;
                }
            } else {
                echo "<tr>
                        <td colspan='4'>No Examinees Found</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

