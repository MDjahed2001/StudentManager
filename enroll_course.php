<?php
include 'db.php';
$success = $error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $course_code = $_POST["course_code"];
    $course_title = $_POST["course_title"];
    $semester = $_POST["semester"];
    if (empty($student_id) || empty($course_code)) {
        $error = "Student ID and Course Code are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO enrollments (student_id, course_code, course_title, semester) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $student_id, $course_code, $course_title, $semester);
        $stmt->execute();
        $stmt->close();
        $success = "Enrollment successful!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Course Enrollment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>Course Enrollment</h2>
    <nav><a href="index.php">Add Student</a> | <a href="student_list.php">Student List</a> | <a href="enroll_course.php">Enroll in Course</a> | <a href="enrollment_history.php">Enrollment History</a></nav>
    <?php if ($success) echo "<div class='alert alert-success mt-2'>$success</div>"; ?>
    <?php if ($error) echo "<div class='alert alert-danger mt-2'>$error</div>"; ?>
    <form method="post" class="mt-3">
        <input class="form-control mb-2" type="text" name="student_id" placeholder="Student ID" required>
        <input class="form-control mb-2" type="text" name="course_code" placeholder="Course Code" required>
        <input class="form-control mb-2" type="text" name="course_title" placeholder="Course Title">
        <select class="form-control mb-2" name="semester">
            <option value="">Select Semester</option>
            <option value="Spring 2025">Spring 2025</option>
            <option value="Fall 2025">Fall 2025</option>
        </select>
        <button class="btn btn-primary">Enroll</button>
    </form>
</body>
</html>
