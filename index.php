<?php

//When this is opened, redirect instantly to src/index.html

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}

redirect("src/main.php");

?>