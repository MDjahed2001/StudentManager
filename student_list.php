<?php
include 'db.php';
$result = $conn->query("SELECT name, student_id, department, major, email FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>Student List</h2>
    <nav><a href="index.php">Add Student</a> | <a href="student_list.php">Student List</a> | <a href="enroll_course.php">Enroll in Course</a> | <a href="enrollment_history.php">Enrollment History</a></nav>
    <table class="table mt-3">
        <thead><tr><th>Name</th><th>Student ID</th><th>Department</th><th>Major</th><th>Email</th></tr></thead>
        <tbody>
        <?php if ($result->num_rows > 0): while($row = $result->fetch_assoc()): ?>
            <tr><td><?= $row["name"] ?></td><td><?= $row["student_id"] ?></td><td><?= $row["department"] ?></td><td><?= $row["major"] ?></td><td><?= $row["email"] ?></td></tr>
        <?php endwhile; else: ?>
            <tr><td colspan='5'>No data in the table</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
