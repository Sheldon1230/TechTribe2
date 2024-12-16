<?php
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_course'])) {
        $id = $_POST['course_id'];
        $conn->query("DELETE FROM course_tbl WHERE cou_id = $id");
    }

    if (isset($_POST['update_course'])) {
        $id = $_POST['course_id'];
        $new_name = strtoupper(trim($_POST['course_name']));
        $conn->query("UPDATE course_tbl SET cou_name = '$new_name' WHERE cou_id = $id");
    }
}

$query = $conn->query("SELECT * FROM course_tbl ORDER BY cou_created DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="test.html">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="manageCourses.php">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="manageExams.php">Exams</a></li>
                <li class="nav-item"><a class="nav-link" href="manageExaminees.php">Examinees</a></li>
            </ul>
        </div>
    </nav>
    <div class="table-responsive mt-3">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Course Name</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($query->rowCount() > 0) {
                    $count = 1;
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$count}</td>
                                <td>{$row['cou_name']}</td>
                                <td>{$row['cou_created']}</td>
                                <td>
                                    <form method='POST' style='display:inline-block;'>
                                        <input type='hidden' name='course_id' value='{$row['cou_id']}'>
                                        <button name='delete_course' class='btn-custom btn-danger-custom'>Delete</button>
                                    </form>
                                    <button class='btn-custom btn-primary-custom' onclick=\"editCourse({$row['cou_id']}, '{$row['cou_name']}')\">Edit</button>
                                </td>
                            </tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No Courses Found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Edit Course Modal -->
    <div id="editCourseModal" class="custom-modal">
        <div class="modal-content-custom">
            <div class="modal-header-custom">
                Edit Course
                <button onclick="closeModal()" style="background: none; border: none; color: white; float: right;">&times;</button>
            </div>
            <form method="POST">
                <input type="hidden" name="course_id" id="edit_course_id">
                <div class="form-group mt-3">
                    <label>Course Name</label>
                    <input type="text" class="form-control" name="course_name" id="edit_course_name" required>
                </div>
                <div class="modal-footer-custom">
                    <button type="submit" name="update_course" class="btn-custom btn-primary-custom">Update</button>
                    <button type="button" class="btn-custom btn-danger-custom" onclick="closeModal()">Close</button>
                </div>
            </form>
        </div>
    </div>

<script>
    function editCourse(id, name) {
        document.getElementById('edit_course_id').value = id;
        document.getElementById('edit_course_name').value = name;
        document.getElementById('editCourseModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('editCourseModal').style.display = 'none';
    }
</script>
</body>
</html>
