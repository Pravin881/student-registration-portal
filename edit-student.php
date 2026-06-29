<?php
require_once "database.php";

if (!isset($_GET['id'])) {
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

<title>Edit Student</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container mt-5">

<div class="card shadow-lg p-4">

<h2 class="text-center mb-4">✏️ Edit Student</h2>

<form action="update-student.php" method="POST">

<input type="hidden" name="id" value="<?php echo $student['id']; ?>">

<div class="mb-3">
<label class="form-label">Full Name</label>
<input
type="text"
name="fullname"
class="form-control"
value="<?php echo htmlspecialchars($student['fullname']); ?>"
required>
</div>

<div class="mb-3">
<label class="form-label">Email Address</label>
<input
type="email"
name="email"
class="form-control"
value="<?php echo htmlspecialchars($student['email']); ?>"
required>
</div>

<div class="mb-3">
<label class="form-label">Mobile Number</label>
<input
type="text"
name="mobile"
maxlength="10"
class="form-control"
value="<?php echo htmlspecialchars($student['mobile']); ?>"
required>
</div>

<div class="mb-3">
<label class="form-label">Date of Birth</label>
<input
type="date"
name="dob"
class="form-control"
value="<?php echo $student['dob']; ?>"
required>
</div>

<div class="mb-3">
<label class="form-label">Gender</label><br>

<input type="radio" name="gender" value="Male"
<?php if($student['gender']=="Male") echo "checked"; ?>>
Male

<input type="radio" name="gender" value="Female"
<?php if($student['gender']=="Female") echo "checked"; ?>>
Female

<input type="radio" name="gender" value="Other"
<?php if($student['gender']=="Other") echo "checked"; ?>>
Other

</div>

<div class="mb-3">

<label class="form-label">Course</label>

<select name="course" class="form-select">

<option <?php if($student['course']=="BCA") echo "selected"; ?>>BCA</option>

<option <?php if($student['course']=="BBA") echo "selected"; ?>>BBA</option>

<option <?php if($student['course']=="BSc") echo "selected"; ?>>BSc</option>

<option <?php if($student['course']=="BCom") echo "selected"; ?>>BCom</option>

<option <?php if($student['course']=="MCA") echo "selected"; ?>>MCA</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">Address</label>

<textarea
name="address"
rows="4"
class="form-control"
required><?php echo htmlspecialchars($student['address']); ?></textarea>

</div>

<button class="btn btn-success w-100">

Update Student

</button>

</form>

</div>

</div>

</body>
</html>