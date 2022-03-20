<?php

    session_start();
    $_SESSION['id'] = "adminIDSuper";
    $_SESSION['username'] = "AdminSuper";
    $_SESSION['type'] = 'supervisor';
    $_SESSION['name'] = "Admin Super";

    header("Location: ../supervisor/index.php");
?>