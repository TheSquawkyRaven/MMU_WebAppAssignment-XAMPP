<?php

    require '../php/connect.php';

    session_start();

    $std = $con->query("SELECT * FROM supervisor WHERE username = 'AdminSuper'");

    if ($std->num_rows > 0){
        $admin = $std->fetch_assoc();
        $_SESSION['id'] = $admin["id"];
        $_SESSION['username'] = $admin["username"];
        $_SESSION['name'] = $admin["name"];
        $_SESSION['type'] = 'supervisor';

        header("Location: ../supervisor/index.php");
    }
    else{
        $sql = "INSERT INTO supervisor(username, password, name, dob, rating, total_rating) VALUES('AdminSuper', 'admin', 'Admin Supervisor', '01-01-0001', '0', '0')";
        $con->query($sql);

        header("Location: adminSupervisor.php");
    }
?>