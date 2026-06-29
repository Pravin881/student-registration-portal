<?php

require_once "database.php";

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $address = trim($_POST['address']);

    // Validation

    if(empty($fullname) || empty($email) || empty($mobile) || empty($dob) || empty($gender) || empty($course) || empty($address)){
        die("All fields are required.");
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        die("Invalid Email Address.");
    }

    if(!preg_match('/^[0-9]{10}$/', $mobile)){
        die("Mobile number must contain exactly 10 digits.");
    }

    // Check duplicate email (except current student)

    $check = "SELECT id FROM students WHERE email = ? AND id != ?";

    $stmt = mysqli_prepare($conn, $check);

    mysqli_stmt_bind_param($stmt, "si", $email, $id);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0){

        die("Email already exists.");

    }

    mysqli_stmt_close($stmt);

    // Update student

    $sql = "UPDATE students
            SET fullname=?, email=?, mobile=?, dob=?, gender=?, course=?, address=?
            WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssssi",
        $fullname,
        $email,
        $mobile,
        $dob,
        $gender,
        $course,
        $address,
        $id
    );

    if(mysqli_stmt_execute($stmt)){

        echo "<script>
                alert('Student Updated Successfully!');
                window.location='student-list.php';
              </script>";

    }else{

        echo "Error : " . mysqli_error($conn);

    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}else{

    header("Location: student-list.php");

}
?>