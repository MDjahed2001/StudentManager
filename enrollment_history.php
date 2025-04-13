<?php
include 'db.php';
$student_id = $_GET['student_id'] ?? '';
$records = [];
if ($student_id) {
    $stmt = $conn->prepare("SELECT course_code, course_title, semester, grade FROM enrollments WHERE student_id=?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) $records[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enrollment History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>Enrollment History</h2>
    <nav><a href="index.php">Add Student</a> | <a href="student_list.php">Student List</a> | <a href="enroll_course.php">Enroll in Course</a> | <a href="enrollment_history.php">Enrollment History</a></nav>
    <form class="mt-3" method="get">
        <input class="form-control mb-2" type="text" name="student_id" placeholder="Enter Student ID" value="<?= htmlspecialchars($student_id) ?>">
        <button class="btn btn-primary">Search</button>
    </form>
    <table class="table mt-3">
        <thead><tr><th>Course Code</th><th>Course Title</th><th>Semester</th><th>Grade</th></tr></thead>
        <tbody>
        <?php if ($student_id && count($records) > 0): foreach ($records as $row): ?>
            <tr><td><?= $row['course_code'] ?></td><td><?= $row['course_title'] ?></td><td><?= $row['semester'] ?></td><td><?= $row['grade'] ?? 'N/A' ?></td></tr>
        <?php endforeach; else: ?>
            <tr><td colspan="4">No data available</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
