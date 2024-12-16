<?php
include("conn.php");

$query = $conn->query("SELECT * FROM exam_tbl ORDER BY ex_created DESC");
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
    <!-- Table Code -->
    <div class="table-responsive mt-3">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Exam Title</th>
                    <th>Time Limit</th>
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
                                <td>{$row['ex_title']}</td>
                                <td>{$row['ex_time_limit']} min</td>
                                <td>{$row['ex_created']}</td>
                                <td>
                                    <form method='POST' style='display:inline-block;'>
                                        <input type='hidden' name='exam_id' value='{$row['ex_id']}'>
                                        <button name='delete_exam' class='btn-custom btn-danger-custom'>Delete</button>
                                    </form>
                                    <button class='btn-custom btn-primary-custom' onclick=\"editExam({$row['ex_id']}, '{$row['ex_title']}')\">Edit</button>
                                </td>
                            </tr>";
                        $count++;
                    }
                } else {
                    echo "<tr>
                            <td colspan='5' class='text-center text-muted'>No Exams Found</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Edit Exam Modal -->
    <div id="editExamModal" class="custom-modal">
        <div class="modal-content-custom">
            <div class="modal-header-custom">
                Edit Exam
                <button onclick="closeModal()" style="background:none; border:none; color:#343a40; font-size:20px; float:right;">&times;</button>
            </div>
            <form method="POST">
                <input type="hidden" name="exam_id" id="edit_exam_id">
                <div class="form-group mt-3">
                    <label>Exam Title</label>
                    <input type="text" class="form-control" name="exam_title" id="edit_exam_title" required>
                </div>
                <div class="form-group">
                    <label>Time Limit (minutes)</label>
                    <input type="number" class="form-control" name="exam_time" id="edit_exam_time" required>
                </div>
                <div class="modal-footer-custom">
                    <button type="submit" name="update_exam" class="btn-custom btn-primary-custom">Update</button>
                    <button type="button" class="btn-custom btn-danger-custom" onclick="closeModal()">Close</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editExam(id, title) {
            document.getElementById('edit_exam_id').value = id;
            document.getElementById('edit_exam_title').value = title;
            document.getElementById('editExamModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('editExamModal').style.display = 'none';
        }
    </script>
</body>
</html>
