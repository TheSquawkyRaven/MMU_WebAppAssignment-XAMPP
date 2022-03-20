<?php

    session_start();
    $_SESSION['id'] = "adminIDStud";
    $_SESSION['username'] = "AdminStud";
    $_SESSION['type'] = 'student';
    $_SESSION['name'] = "Admin Student";

    header("Location: ../student/index.php");

?>