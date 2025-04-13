<?php
include 'db.php';
$name = $email = $student_id = $department = $major = $dob = $address = "";
$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $student_id = $_POST["student_id"];
    $department = $_POST["department"];
    $major = $_POST["major"];
    $dob = $_POST["dob"];
    $address = $_POST["address"];

    if (empty($name) || empty($email)) {
        $error = "Name and Email are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (name, email, student_id, department, major, dob, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $student_id, $department, $major, $dob, $address);
        $stmt->execute();
        $stmt->close();
        $success = "Student registered successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>Student Registration</h2>
    <nav><a href="index.php">Add Student</a> | <a href="student_list.php">Student List</a> | <a href="enroll_course.php">Enroll in Course</a> | <a href="enrollment_history.php">Enrollment History</a></nav>
    <?php if ($success) echo "<div class='alert alert-success mt-2'>$success</div>"; ?>
    <?php if ($error) echo "<div class='alert alert-danger mt-2'>$error</div>"; ?>
    <form method="post" class="mt-3">
        <input class="form-control mb-2" type="text" name="name" placeholder="Name" required>
        <input class="form-control mb-2" type="email" name="email" placeholder="Email" required>
        <input class="form-control mb-2" type="text" name="student_id" placeholder="Student ID">
        <select class="form-control mb-2" name="department">
            <option value="">Select Department</option>
            <option value="CSE">CSE</option><option value="EEE">EEE</option>
        </select>
        <select class="form-control mb-2" name="major">
            <option value="">Select Major</option>
            <option value="AI">AI</option><option value="Networking">Networking</option>
        </select>
        <input class="form-control mb-2" type="date" name="dob">
        <textarea class="form-control mb-2" name="address" placeholder="Address"></textarea>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>
