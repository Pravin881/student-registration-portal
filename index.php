<?php
require_once "database.php";

// Count Total Students
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$row = mysqli_fetch_assoc($result);
$totalStudents = $row['total'];

// Count Courses
$result2 = mysqli_query($conn, "SELECT COUNT(DISTINCT course) AS total_courses FROM students");
$row2 = mysqli_fetch_assoc($result2);
$totalCourses = $row2['total_courses'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Registration Portal</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<div class="container">

<div class="card p-5 shadow-lg">

<h1 class="text-center text-primary mb-4">

🎓 Student Registration Portal

</h1>

<p class="text-center text-muted mb-5">

Welcome! Manage student records easily.

</p>

<div class="row mb-4">

<div class="col-md-6">

<div class="card text-center p-4 shadow-sm">

<h5>Total Students</h5>

<h1 class="text-primary">

<?php echo $totalStudents; ?>

</h1>

</div>

</div>

<div class="col-md-6">

<div class="card text-center p-4 shadow-sm">

<h5>Courses Available</h5>

<h1 class="text-success">

<?php echo $totalCourses; ?>

</h1>

</div>

</div>

</div>

<div class="d-grid gap-3">

<a href="student-registration.php" class="btn btn-primary btn-lg">

<i class="bi bi-person-plus-fill"></i>

Register Student

</a>

<a href="student-list.php" class="btn btn-success btn-lg">

<i class="bi bi-table"></i>

View Students

</a>

<a href="student-list.php" class="btn btn-warning btn-lg">

<i class="bi bi-search"></i>

Search Students

</a>

</div>

<hr class="my-4">

<p class="text-center text-secondary">

Developed by <strong>Pravin B</strong>

<br>



</p>

</div>

</div>

</body>
</html>