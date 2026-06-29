<?php
require_once "database.php";

$search = "";

if(isset($_GET['search'])){

    $search = trim($_GET['search']);

    $sql = "SELECT * FROM students
            WHERE fullname LIKE ?
            OR email LIKE ?
            OR mobile LIKE ?
            OR course LIKE ?
            ORDER BY id DESC";

    $stmt = mysqli_prepare($conn, $sql);

    $searchValue = "%".$search."%";

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $searchValue,
        $searchValue,
        $searchValue,
        $searchValue
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

}else{

    $sql = "SELECT * FROM students ORDER BY id DESC";

    $result = mysqli_query($conn, $sql);

} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Students</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow p-4">

        <form method="GET" class="row g-2 mb-4">

    <div class="col-md-9">

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="🔍 Search by Name, Email, Mobile or Course..."
            value="<?php echo htmlspecialchars($search); ?>">

    </div>

    <div class="col-md-3 d-grid">

        <button class="btn btn-primary">

            <div class="col-md-3 d-flex gap-2">

    <button class="btn btn-primary w-100">

        Search

    </button>

    <a href="student-list.php" class="btn btn-secondary">

        Show All

    </a>

</div>

        </button>

    </div>

</form>
            <h2>📋 Registered Students</h2>

            <a href="student-registration.php" class="btn btn-success">
                + Register New Student
            </a>

        </div>

        

        <table class="table table-bordered table-hover text-center">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Full Name</th>

                    <th>Email</th>

                    <th>Mobile</th>

                    <th>Course</th>

                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

            <?php

            if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_assoc($result)){

            ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo htmlspecialchars($row['fullname']); ?></td>

                    <td><?php echo htmlspecialchars($row['email']); ?></td>

                    <td><?php echo htmlspecialchars($row['mobile']); ?></td>

                    <td><?php echo htmlspecialchars($row['course']); ?></td>

                   <td>

    <a href="student-details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
        View
    </a>

    <a href="edit-student.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
        Edit
    </a>

    <a href="delete-student.php?id=<?php echo $row['id']; ?>"
       class="btn btn-danger btn-sm"
       onclick="return confirm('Are you sure you want to delete this student?');">
        Delete
    </a>

</td>

                </tr>

            <?php

                }

            }else{

                echo "<tr><td colspan='6'>No Students Found.</td></tr>";

            }

            ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>