<?php
    require 'connect.php';

    $username = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string($_POST['password']);
    $type = '';

    $username_student = $con->query("SELECT * FROM student WHERE username = '$username'");
    $username_supervisor = $con->query("SELECT * FROM supervisor WHERE username = '$username'");
    $username_moderator = $con->query("SELECT * FROM moderator WHERE username = '$username'");

    if($username_student->num_rows > 0) $type = 'student';
    else if($username_supervisor->num_rows > 0) $type = 'supervisor';
    else if($username_moderator->num_rows > 0) $type = 'moderator';

    if($type != '') {
        $search = $con->query("SELECT * FROM $type WHERE username = '$username'");
        $user = $search->fetch_assoc();

        if(password_verify($password, $user['password'])) {
            
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['type'] = $type;

            echo $type;
        }else {
            echo 'Invalid username or password';
        }

    }else {
        echo 'Invalid username or password';
    }
?>