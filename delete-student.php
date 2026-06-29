<?php

require_once "database.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM students WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    if(mysqli_stmt_execute($stmt)){

        echo "<script>

            alert('Student Deleted Successfully!');

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