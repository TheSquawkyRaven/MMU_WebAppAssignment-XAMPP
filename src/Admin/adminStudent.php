<?php
    require '../php/connect.php';

    session_start();

    $std = $con->query("SELECT * FROM student WHERE username = 'AdminStud'");

    if ($std->num_rows > 0){
        $admin = $std->fetch_assoc();
        $_SESSION['id'] = $admin["id"];
        $_SESSION['username'] = $admin["username"];
        $_SESSION['name'] = $admin["name"];
        $_SESSION['type'] = 'student';

        header("Location: ../student/index.php");
    }
    else{
        $sql = "INSERT INTO student(username, password, name, dob, state) VALUES('AdminStud', 'admin', 'Admin Student', '01-01-0001', '1')";
        $con->query($sql);

        header("Location: adminStudent.php");
    }



?>