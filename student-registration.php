<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container mt-5 mb-5">

    <div class="card shadow-lg p-4">

        <h2 class="text-center mb-4">
            Student Registration Portal
        </h2>

        <form action="save-student.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="text"
                       name="mobile"
                       class="form-control"
                       maxlength="10"
                       pattern="[0-9]{10}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label><br>

                <input type="radio" name="gender" value="Male" required> Male

                <input type="radio" name="gender" value="Female"> Female

                <input type="radio" name="gender" value="Other"> Other

            </div>

            <div class="mb-3">

                <label class="form-label">Course</label>

                <select name="course" class="form-select" required>

                    <option value="">Select Course</option>

                    <option>BCA</option>

                    <option>BBA</option>

                    <option>BSc</option>

                    <option>BCom</option>

                    <option>MCA</option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">Address</label>

                <textarea
                    name="address"
                    rows="4"
                    class="form-control"
                    required></textarea>

            </div>

            <button class="btn btn-primary w-100" type="submit">

                Register Student

            </button>

        </form>

    </div>

</div>

</body>
</html>