<?php

require_once "database.php";

if(isset($_POST['fullname'])){

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
        die("Mobile Number must contain exactly 10 digits.");
    }

    // Duplicate Email Check

    $check = "SELECT id FROM students WHERE email = ?";
    $stmt = mysqli_prepare($conn, $check);

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0){
        die("Email already registered.");
    }

    mysqli_stmt_close($stmt);

    // Insert Student

    $sql = "INSERT INTO students(fullname,email,mobile,dob,gender,course,address)
            VALUES(?,?,?,?,?,?,?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssss",
        $fullname,
        $email,
        $mobile,
        $dob,
        $gender,
        $course,
        $address
    );
if(mysqli_stmt_execute($stmt)){

    echo "<script>
    alert('Student Registered Successfully!');
    window.location='student-list.php';
    </script>";

}else{

        echo "Error : ".mysqli_error($conn);

    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}else{

    header("Location: student-registration.php");

}
?>