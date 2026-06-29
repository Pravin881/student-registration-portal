<?php
require_once "database.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Student ID.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM students WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    die("Student not found.");
}

$student = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow-lg p-4">

        <h2 class="text-center mb-4">
            🎓 Student Details
        </h2>

        <table class="table table-bordered">

            <tr>
                <th width="30%">Student ID</th>
                <td><?php echo $student['id']; ?></td>
            </tr>

            <tr>
                <th>Full Name</th>
                <td><?php echo htmlspecialchars($student['fullname']); ?></td>
            </tr>

            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($student['email']); ?></td>
            </tr>

            <tr>
                <th>Mobile Number</th>
                <td><?php echo htmlspecialchars($student['mobile']); ?></td>
            </tr>

            <tr>
                <th>Date of Birth</th>
                <td><?php echo htmlspecialchars($student['dob']); ?></td>
            </tr>

            <tr>
                <th>Gender</th>
                <td><?php echo htmlspecialchars($student['gender']); ?></td>
            </tr>

            <tr>
                <th>Course</th>
                <td><?php echo htmlspecialchars($student['course']); ?></td>
            </tr>

            <tr>
                <th>Address</th>
                <td><?php echo nl2br(htmlspecialchars($student['address'])); ?></td>
            </tr>

        </table>

        <div class="text-center">

            <a href="student-list.php" class="btn btn-primary">
                ← Back to Student List
            </a>

        </div>

    </div>

</div>

</body>
</html>