<?php

    session_start();
    $_SESSION['id'] = "adminIDMod";
    $_SESSION['username'] = "AdminMod";
    $_SESSION['type'] = 'moderator';
    $_SESSION['name'] = "Admin Mod";

    header("Location: ../moderator/index.php");

?>