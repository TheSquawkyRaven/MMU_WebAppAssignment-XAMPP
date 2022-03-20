<?php
    require 'connect.php';

    $username = $con->real_escape_string($_POST['username']);
    $name = $con->real_escape_string($_POST['name']);
    $password = $con->real_escape_string($_POST['password']);
    $type = $con->real_escape_string($_POST['type']);
    $dob = $con->real_escape_string($_POST['dob']);

    $username_student = $con->query("SELECT * FROM student WHERE username = '$username'");
    $username_supervisor = $con->query("SELECT * FROM supervisor WHERE username = '$username'");
    $username_moderator = $con->query("SELECT * FROM moderator WHERE username = '$username'");

    if(($username_student->num_rows == 0) && ($username_supervisor->num_rows == 0) && ($username_moderator->num_rows == 0)) { // no duplicate username
        $password = $con->real_escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
        $sql = '';

        if($type == 'student') {
            $sql = "INSERT INTO student(username, password, name, dob, state) VALUES('$username', '$password', '$name', '$dob', '1')";
        }else { // supervisor
            $sql = "INSERT INTO supervisor(username, password, name, dob, rating, total_rating) VALUES('$username', '$password', '$name', '$dob', '0', '0')";
        }

        if($con->query($sql))
            echo 'true';
        else {
            echo 'Error';
        }
    }else {
        echo 'Username Already Exist';
    }
?>